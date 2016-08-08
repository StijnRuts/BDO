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
				'order' => array('startnrorder'=>'asc')
			))
		)));

		$this->Contestant->id = $contestant_id;
		$this->set('contestant', $this->Contestant->read());
		$this->set('scores', $this->Contestant->getScores($round_id));

		//set empty score
		$this->loadModel('Adminscore');
		$data = array(
			'contestant_id' => $contestant_id,
			'round_id' => $round_id
		);
		if( !$this->Adminscore->hasAny($data) ) {
			$this->Adminscore->create();
			$this->Adminscore->save($data);
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Adminscore->save($this->request->data)) {
				$this->Session->setFlash('De beheerdersbeoordeling is opgeslaan', 'flash_success');
			} else {
				$this->Session->setFlash('De beheerdersbeoordeling kon niet worden opgeslaan', 'flash_error');
			}
		}
		$this->request->data = $this->Adminscore->find('first', array(
			'conditions' => array('contestant_id'=>$contestant_id, 'round_id'=>$round_id)
		));
	}

	public function viewcontent($contestant_id = null, $round_id = null) {
		$this->request->onlyAllow('ajax');
		$this->layout = 'ajax';

		$this->loadModel('Contestant');
		$this->loadModel('Round');
		if (!$this->Contestant->exists($contestant_id)) throw new NotFoundException();
		if (!$this->Round->exists($round_id)) throw new NotFoundException();
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

	public function editscores($contestant_id = null, $round_id = null, $user_id = null) {
		$this->loadModel('Score');
		$this->loadModel('Contestant');
		$this->loadModel('Round');
		$this->loadModel('User');
		if (!$this->Contestant->exists($contestant_id)) throw new NotFoundException();
		if (!$this->Round->exists($round_id)) throw new NotFoundException();
		if (!$this->User->exists($user_id)) throw new NotFoundException();
		$this->Contestant->id = $contestant_id;
		$this->set('contestant', $this->Contestant->read());
		$this->Round->id = $round_id;
		$round = $this->Round->read();
		$this->User->id = $user_id;
		$this->set('user', $this->User->read());

		// create empty score objects
		$scores = $this->Contestant->getScores($round_id);
		$this->Score->setEmptyScores($scores['points'], $round_id, $contestant_id, $user_id);
		$scores = $this->Contestant->getScores($round_id);
		$this->set('scores', $scores);

		//load scores
		foreach($round['Contestant'] as &$contestant){
			$this->Contestant->id = $contestant['id'];
			$score = $this->Contestant->getScores($round_id);
			$juryscores = $score['scores'][$user_id];
			$juryscores[-1] = isset($juryscores[-1]) ? $juryscores[-1] : 0;
			$contestant['score'] = $juryscores['total']-$juryscores[-1];
		}
		$this->set('round', $round);

		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->Score->saveAll($this->request->data['Score'])){

				// check if score equals previous score in same round for same judge
				$otherscores = array();
				foreach($round['Contestant'] as $contestant) {
					if( $contestant['id'] != $contestant_id ) {
						array_push($otherscores, $contestant['score']);
					}
				}

				$this->Contestant->id = $contestant_id;
				$newscore = $this->Contestant->getScores($round_id);
				$newscore = $newscore['scores'][$user_id]['total'];

				if( in_array($newscore, $otherscores) ) {
					$this->Session->setFlash("Deze score komt al voor", 'flash_error');
					$this->redirect('#');
				}

				$this->redirect(array('action'=>'view', $contestant_id, $round_id));
				$this->Session->setFlash("De scores zijn opgeslaan", 'flash_success');
			}else{
				$submitted_values = $this->request->data['Score'];
				$this->Session->setFlash("Deze scores konden niet worden opgeslaan", 'flash_error');
			}
		}

		// load data
		$this->request->data = array('Score' => Set::combine(
			$this->Score->find('all', array(
				'conditions'=>array(
					'user_id'=>$user_id,
					'contestant_id'=>$contestant_id,
					'round_id'=>$round_id
				)
			)),
			'{n}.Score.id', '{n}.Score'
		));

		// show submitted scores if validation failed
		if ($this->request->is('post') || $this->request->is('put')) {
			foreach($this->request->data['Score'] as $key=>&$score){
				if( isset($submitted_values[$key]['score']) ){
					$score['score'] = $submitted_values[$key]['score'];
				}
			}
		}
	}

	// stage jurylid voor beoordeling van deelemer
	public function stage($contestant_id = null, $round_id = null, $user = 'all') {
		$this->loadModel('Stage');
		if ($user == 'all') {
			$this->loadModel('Round');
			$this->Round->id = $round_id;
			$round = $this->Round->read();
		 	foreach ($round['User'] as $u) {
				$this->savestage($contestant_id, $round_id, $u['id']);
			}
		} else {
			$this->savestage($contestant_id, $round_id, $user);
		}
		if (!$this->request->isAjax()) {
			$this->redirect($this->referer());
		}
		exit();
	}

	private function savestage($contestant_id, $round_id, $user_id) {
		$data = array(
			'contestant_id' => $contestant_id,
			'round_id' => $round_id,
			'user_id' => $user_id
		);
		if (!$this->Stage->hasAny($data)) {
			$this->Stage->create();
			$this->Stage->save($data);
		}
	}
}
