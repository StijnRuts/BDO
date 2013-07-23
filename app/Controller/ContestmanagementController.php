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
		$this->loadModel('Contestant');
		if (!$this->Round->exists($round_id)) throw new NotFoundException();
		$round = $this->Round->find('first', array(
			'conditions' => array('Round.id'=>$round_id),
			'order'=>'Round.order',
			'contain' => array('Category', 'Discipline', 'Division', 'Contestant'=>array('order'=>'startnrorder'), 'Contestant.Club')
		));
		foreach ($round['Contestant'] as &$contestant){
			$this->Contestant->id = $contestant['id'];
			$contestant['scores'] = $this->Contestant->getScores($round['Round']['id']);
		}
		$this->set('round', $round);
		$this->set('contest', $this->Contest->find('first', array(
			'conditions' => array('Contest.id'=>$round['Round']['contest_id']),
			'contain' => array('Round' => array('order'=>'Round.order', 'Category', 'Discipline', 'Division'))
		)));

		$this->loadModel('Stage');
		$stage = $this->Stage->find('all');
		foreach($stage as &$s){
			$c = $this->Contestant->find('first', array(
				'conditions'=>array('Contestant.id'=>$s['Stage']['contestant_id']),
				'fields'=>array('name', 'startnr')
			));
			$s['Contestant'] = $c['Contestant'];
		}
		$this->set('stage', $stage);

		$this->Session->write('recent.round', $round['Round']['id']);
		$this->Session->write('recent.contest', $round['Round']['contest_id']);
	}

	public function clearscores($id = null) {
		$this->loadModel('Round');
		$this->loadModel('Score');
		$this->loadModel('Adminscore');
		if (!$this->Round->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');
		if ($this->Score->deleteAll(array('round_id'=>$id)) && $this->Adminscore->deleteAll(array('round_id'=>$id))) {
			$this->Session->setFlash('Alle scores zijn verwijderd', 'flash_info');
		} else {
			$this->Session->setFlash('De scores konden niet worden verwijderd', 'flash_error');
		}
		$this->redirect(array('action'=>'view', $id));
	}

}
?>