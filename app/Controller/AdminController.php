<?php
class AdminController extends AppController {
	public function index() {
	}
	public function ledenbeheer() {
		$this->redirect(array('controller'=>'contestants'));
	}
}
?>