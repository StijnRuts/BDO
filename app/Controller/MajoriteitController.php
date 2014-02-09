<?php
class MajoriteitController extends AppController {
	public function view($round_id = null) {

		$this->loadModel('Contest');
		$this->loadModel('Round');
		$this->loadModel('Contestant');

		if (!$this->Round->exists($round_id)) throw new NotFoundException();

		$round = $this->Round->find('first', array(
			'conditions' => array('Round.id'=>$round_id),
			'order'=>'Round.order',
			'contain' => array('Category', 'Discipline', 'Division', 'Contestant'=>array('order'=>'startnrorder'))
		));

		foreach ($round['Contestant'] as &$contestant){
			$this->Contestant->id = $contestant['id'];
			$contestant['scores'] = $this->Contestant->getScores($round_id);
		}

		$this->set('round', $round);

		$this->set('contest', $this->Contest->find('first', array(
			'conditions' => array('Contest.id'=>$round['Round']['contest_id'])
		)));

	}
}