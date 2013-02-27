<?php
class ContestantmanagementController extends AppController {

	public function view($contestant_id = null, $round_id = null) {
		$this->loadModel('Contestant');
		$this->loadModel('Round');
		if (!$this->Contestant->exists($contestant_id)) throw new NotFoundException();
		if (!$this->Round->exists($round_id)) throw new NotFoundException();
		$this->Round->id = $round_id;
		$this->set('round', $this->Round->find('first', array(
			'conditions' => array('id'=>$round_id),
			'contain' => array('Contestant'=>array(
				'order' => array('startnr'=>'asc')
			))
		)));
		$this->Contestant->id = $contestant_id;
		$this->set('contestant', $this->Contestant->read());
		$this->set('scores', $this->Contestant->getScores($round_id));
	}

	public function viewcontent($contestant_id = null, $round_id = null) {
		$this->request->onlyAllow('ajax');
		$this->layout = 'ajax';

		$this->loadModel('Contestant');
		$this->loadModel('Round');
		$this->Contestant->id = $contestant_id;
		$this->set('scores', $this->Contestant->getScores($round_id));

		$this->loadModel('Stage');
		$this->set('staged', $this->Stage->find('all', array(
			'conditions' => array('contestant_id'=>$contestant_id, 'round_id'=>$round_id),
			'contain' => array('User'=>array(
				'order' => array('username'=>'asc')
			))
		)));
	}

	// stage jurylid voor beoordeling van deelemer
	public function stage($contestant_id = null, $round_id = null, $user = 'all') {
		$this->loadModel('Stage');
		if($user=='all'){
			$this->loadModel('Round');
			$this->loadModel('Contest');
			$this->Round->id = $round_id;
			$round = $this->Round->read();
			$contest = $this->Contest->find('first', array(
				'conditions' => array('id'=>$round['Contest']['id']),
				'contain'=>array(	'User' => array(
					'conditions' => array('User.role'=>'jury'),
					'fields' => array('User.id')
				))
			));
		 	foreach($contest['User'] as $u) $this->savestage($contestant_id, $round_id, $u['id']);
		} else {
			$this->savestage($contestant_id, $round_id, $user);
		}
		if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
	}
	private function savestage($contestant_id, $round_id, $user_id){
		$data = array(
			'contestant_id' => $contestant_id,
			'round_id' => $round_id,
			'user_id' => $user_id
		);
		if( !$this->Stage->hasAny($data)) {
			$this->Stage->create();
			$this->Stage->save($data);
		}
	}
}
?>