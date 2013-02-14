<?php
class ContestmanagementController extends AppController {

	public function index() {
		$this->loadModel('Contest');
		$this->Contest->recursive = 0;
		$this->set('contests', $this->Contest->find('all', array(
			'order' => array('Contest.date' => 'asc'),
		)));
	}

	public function view($contest_id = null) {
		$this->loadModel('Contest');
		if (!$this->Contest->exists($contest_id)) throw new NotFoundException();
		$this->set('contest', $this->Contest->find('first', array(
			'conditions' => array('Contest.id'=>$contest_id),
			'contain' => array('Round' => array('order'=>'Round.order', 'Category', 'Discipline', 'Division', 'Contestant'))
		)));
	}

}
?>