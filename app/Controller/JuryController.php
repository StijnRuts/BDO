<?php
class JuryController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$current_user = $this->Auth->user();
		if($current_user['role']=='jury') $this->Auth->allow('index', 'startjudging', 'judge', 'checkstage');
	}

	public function index() {	}

	public function startjudging(){
		$this->loadModel('Stage');
		$current_user = $this->Auth->user();
		$stage = $this->Stage->findByUser_id($current_user['id']);
		if( count($stage)==0 ) $this->redirect(array('action'=>'index'));
		$this->redirect(array('action'=>'judge', $stage['Stage']['contestant_id'], $stage['Stage']['round_id']));
	}

	public function judge($contestant_id = null, $round_id = null) {
		$this->loadModel('Contestant');
		$this->loadModel('Round');
		if (!$this->Contestant->exists($contestant_id)) throw new NotFoundException();
		if (!$this->Round->exists($round_id)) throw new NotFoundException();
		$this->Round->id = $round_id;
		$this->set('round', $this->Round->read());
		$this->Contestant->id = $contestant_id;
		$this->set('contestant', $this->Contestant->read());
	}

	public function checkstage(){
		$this->request->onlyAllow('ajax');
		$this->loadModel('Stage');
		$current_user = $this->Auth->user();
		$stage = $this->Stage->findByUser_id($current_user['id']);
		echo ( count($stage)>0 );
		exit();
	}

}
?>