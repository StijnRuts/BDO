<?php
class AdminController extends AppController {
	public function index() {
	}
	public function wedstrijdbeheer() {
		$this->redirect(array('controller'=>'contests'));
	}
	public function ledenbeheer() {
		$this->redirect(array('controller'=>'contestants'));
	}
	public function instellingen() {
		$this->redirect(array('controller'=>'categories'));
	}

	public function resetstartnrorder() {
		$this->loadModel('Contestant');
		$this->Contestant->recursive = -1;
		$contestants = $this->Contestant->find('all');

		if ($this->Contestant->saveMany($contestants)) {
			$this->Session->setFlash('Startnrorders zijn gereset', 'flash_success');
		} else {
			$this->Session->setFlash('Startnrorder konden niet worden gereset', 'flash_error');
		}
		$this->redirect(array('action'=>'index'));
	}
}
?>