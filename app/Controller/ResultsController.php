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
			case 'contestant': $this->contestant_results($ini['id'], $ini['round_id']); break;
			case 'welcome': $this->welcome(); break;
			default: echo "Error"; break;
		}
	}
	private function contest_results($id = null) {
		$this->loadModel('Contest');
		$this->loadModel('Contestant');
		if (!$this->Contest->exists($id)) throw new NotFoundException();
		$contest = $this->Contest->find('first', array(
			'conditions' => array('Contest.id'=>$id),
			'contain' => array(
				'Round'=>array('order'=>'order'),
				'Round.Contestant'=>array('order'=>'startnr'),
				'Round.Category',
				'Round.Discipline',
				'Round.Division'
			)
		));
		foreach($contest['Round'] as &$round){
			foreach($round['Contestant'] as &$contestant){
				$this->Contestant->id = $contestant['id'];
				$contestant['scores'] = $this->Contestant->getScores($round['id']);
			}
		}
		$this->set('contest', $contest);

		$this->layout = 'ajax';
		$this->render('contest_results');
	}
	private function round_results($id = null) {
		$this->loadModel('Round');
		$this->loadModel('Contestant');
		if (!$this->Round->exists($id)) throw new NotFoundException();
		$round = $this->Round->find('first', array(
			'conditions' => array('Round.id'=>$id),
			'contain' => array('Contestant'=>array('order'=>'startnr'), 'Category', 'Discipline', 'Division')
		));
		foreach($round['Contestant'] as &$contestant){
			$this->Contestant->id = $contestant['id'];
			$contestant['scores'] = $this->Contestant->getScores($id);
		}
		$this->set('round', $round);

		$this->layout = 'ajax';
		$this->render('round_results');
	}
	private function contestant_results($contestant_id = null, $round_id = null) {
		$this->loadModel('Contestant');
		$this->loadModel('Round');
		if (!$this->Contestant->exists($contestant_id)) throw new NotFoundException();
		if (!$this->Round->exists($round_id)) throw new NotFoundException();
		$this->Contestant->id = $contestant_id;
		$this->set('contestant', $this->Contestant->read());
		$this->set('scores', $this->Contestant->getScores($round_id));

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
	public function showcontestant($id = null, $round_id = null){
		$this->write_ini("contestant", $id, $round_id);
		if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
	}

	private function write_ini($type, $id, $round_id = null) {
		$fh = fopen($this->inifile, 'w');
		fwrite($fh,"type=$type\r\nid=$id");
		if($round_id) fwrite($fh,"\r\nround_id=$round_id");
		fclose($fh);
	}
}
?>