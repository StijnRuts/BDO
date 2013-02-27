<?php
class JuryController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		if($current_user['role']='jury') $this->Auth->allow('index', 'judge', 'ready');
	}

	public function index() {
	}

	public function judge($contestant_id = null, $round_id = null) {
	}

	public function ready(){
		$this->request->onlyAllow('ajax');
		$this->loadModel('Stage');
		echo ( count( $this->Stage->findByUser_id(3/*$current_user['id']*/) ) > 0 );
		exit();
	}

}
?>