<?php
class ContestantmanagementController extends AppController {

	public function view($id = null) {
		$this->loadModel('Contestant');
		if (!$this->Contestant->exists($id)) throw new NotFoundException();
		$this->Contestant->id = $id;
		$this->set('contestant', $this->Contestant->read());
	}

}
?>