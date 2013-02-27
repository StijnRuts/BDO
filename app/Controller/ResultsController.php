<?php
class ResultsController extends AppController {

	function beforeFilter(){
		$this->Auth->allow('index', 'results');
		$this->inifile =  ROOT.DS.APP_DIR.DS."scorebord.ini";
	}

	public function index() {
		$this->write_ini("welcome", null);
		$this->layout = 'results';
	}


	public function results() {
		$this->request->onlyAllow('ajax');
		$ini = parse_ini_file($this->inifile);
		switch($ini['type']){
			case 'contest': $this->contest_results($ini['id']); break;
			case 'round': $this->round_results($ini['id']); break;
			case 'contestant': $this->contestant_results($ini['id']); break;
			case 'welcome': $this->welcome(); break;
			default: echo "Error"; break;
		}
	}
	private function contest_results($id = null) {
		$this->layout = 'ajax';
		$this->render('contest_results');
	}
	private function round_results($id = null) {
		$this->layout = 'ajax';
		$this->render('round_results');
	}
	private function contestant_results($id = null) {
		$this->layout = 'ajax';
		$this->render('contestant_results');
	}
	private function welcome() {
		$this->layout = 'ajax';
		$this->render('welcome');
	}


	public function showcontest($id = null){
		$this->write_ini("contest", $id);
		if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
	}
	public function showround($id = null){
		$this->write_ini("round", $id);
		if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
	}
	public function showcontestant($id = null){
		$this->write_ini("contestant", $id);
		if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
	}

	private function write_ini($type, $id) {
		$fh = fopen($this->inifile, 'w');
		fwrite($fh,"type=$type\r\nid=$id");
		fclose($fh);
	}
}
?>