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
		$current_user = $this->Auth->user();
		$this->loadModel('Score');

		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->Score->saveAll($this->request->data['Score'])){
				$this->loadModel('Stage');
				$this->Stage->deleteAll(array(
					'contestant_id' => $contestant_id,
					'round_id' => $round_id,
					'user_id' => $current_user['id']
				));
				$this->redirect(array('action'=>'index'));
			}else{
				$this->Session->setFlash("Deze scores konden niet worden opgeslaan");
			}
		}

		$this->loadModel('Contestant');
		$this->loadModel('Round');
		if (!$this->Contestant->exists($contestant_id)) throw new NotFoundException();
		if (!$this->Round->exists($round_id)) throw new NotFoundException();
		$this->Contestant->id = $contestant_id;
		$this->set('contestant', $this->Contestant->read());

		$scores = $this->Contestant->getScores($round_id);
		$this->setEmptyPoints($scores['points'], $round_id, $contestant_id, $current_user['id']);
		$scores = $this->Contestant->getScores($round_id);
		$this->set('scores', $scores);

		$this->request->data = array('Score' => Set::combine(
			$this->Score->find('all', array(
				'conditions'=>array(
					'user_id'=>$current_user['id'],
					'contestant_id'=>$contestant_id,
					'round_id'=>$round_id
				)
			)),
			'{n}.Score.id', '{n}.Score'
		));
	}
	private function setEmptyPoints($list, $round_id, $contestant_id, $user_id){
		foreach($list as $point){
			$data = array(
				'contestant_id' => $contestant_id,
				'round_id' => $round_id,
				'point_id' => $point['Point']['id'],
				'user_id' => $user_id
			);
			if( !$this->Score->hasAny($data)) {
				$this->Score->create();
				$this->Score->save($data);
			}
			if( count($point['children'])>0 ) $this->setEmptyPoints($point['children'], $round_id, $contestant_id, $user_id);
		}
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