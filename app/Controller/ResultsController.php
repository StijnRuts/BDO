<?php
class ResultsController extends AppController {

	public function index() {
		$this->layout = 'results';
	}

	public function results() {
		$this->layout = 'ajax';
	}
}
?>