<?php
class ContestmanagementController extends AppController {

	public function index() {
		$this->loadModel('Contest');
		$this->Contest->recursive = 0;
		$this->set('contests', $this->Contest->find('all', array(
			'order' => array('Contest.date' => 'asc'),
		)));
	}

	public function contest($contest_id = null) {
		$this->loadModel('Contest');
		if (!$this->Contest->exists($contest_id)) throw new NotFoundException();
		$contest = $this->Contest->find('first', array(
			'conditions' => array('Contest.id'=>$contest_id),
			'contain' => array('Round' => array('order'=>'Round.order'))
		));
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
			'contain' => array('Category', 'Discipline', 'Division', 'Contestant')
		));
		$this->set('round', $round);
		$this->set('contest', $this->Contest->find('first', array(
			'conditions' => array('Contest.id'=>$round['Round']['contest_id']),
			'contain' => array('Round' => array('order'=>'Round.order', 'Category', 'Discipline', 'Division'))
		)));
	}

}
?>