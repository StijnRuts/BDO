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
}
?>