<?php
class ContestmanagementController extends AppController {

	public function index() {
		//if recent is set => redirect
		if($this->Session->check('recent.round')) $this->redirect(array('action'=>'view', $this->Session->read('recent.round')));
		if($this->Session->check('recent.contest')) $this->redirect(array('action'=>'contest', $this->Session->read('recent.contest')));

		//otherwise, redirect to first contest
		$this->loadModel('Contest');
		$this->Contest->recursive = 0;
		$contests = $this->Contest->find('all', array(
			'order' => array('Contest.date' => 'asc')
		));
		if( isset($contests[0]) ){
			$this->redirect( array('action'=>'contest', $contests[0]['Contest']['id']) );
		} else {
			exit();
		}
	}

	public function contest($contest_id = null) {
		$this->loadModel('Contest');
		if (!$this->Contest->exists($contest_id)) throw new NotFoundException();
		$contest = $this->Contest->find('first', array(
			'conditions' => array('Contest.id'=>$contest_id),
			'contain' => array('Round' => array('order'=>'Round.order'))
		));

		//if recent round is set AND round belongs to this contest => redirect
		if($this->Session->check('recent.round')){
			$roundid = $this->Session->read('recent.round');
			foreach($contest['Round'] as $round){
				if($round['id']==$roundid) $this->redirect(array('action'=>'view', $roundid));
			}
			$this->Session->delete('recent.round');
		}

		//otherwise, redirect ot first round in contest
		if( isset($contest['Round'][0]) ){
			$this->redirect( array('action'=>'view', $contest['Round'][0]['id']) );
		} else {
			exit();
		}
	}

	public function view($round_id = null) {
		$this->loadModel('Contest');
		$this->loadModel('Round');
		if (!$this->Round->exists($round_id)) throw new NotFoundException();
		$round = $this->Round->find('first', array(
			'conditions' => array('Round.id'=>$round_id),
			'order'=>'Round.order',
			'contain' => array('Category', 'Discipline', 'Division', 'Contestant'=>array('order'=>'startnr'))
		));
		$this->set('round', $round);
		$this->set('contest', $this->Contest->find('first', array(
			'conditions' => array('Contest.id'=>$round['Round']['contest_id']),
			'contain' => array('Round' => array('order'=>'Round.order', 'Category', 'Discipline', 'Division'))
		)));

		$this->Session->write('recent.round', $round['Round']['id']);
		$this->Session->write('recent.contest', $round['Round']['contest_id']);
	}

}
?>