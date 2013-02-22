<?php
class ContestantmanagementController extends AppController {

	public function view($contestant_id = null, $round_id = null) {
		$this->loadModel('Contestant');
		$this->loadModel('Round');
		if (!$this->Contestant->exists($contestant_id)) throw new NotFoundException();
		if (!$this->Round->exists($round_id)) throw new NotFoundException();
		$this->Contestant->id = $contestant_id;
		$this->set('contestant', $this->Contestant->read());
		$this->set('scores', $this->Contestant->getScores($round_id));
	}

}
?>