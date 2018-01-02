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

	public function resetstartnrorder() {
		$this->loadModel('Contestant');
		$this->Contestant->recursive = -1;
		$contestants = $this->Contestant->find('all');

		if ($this->Contestant->saveMany($contestants)) {
			$this->Session->setFlash('Startnrorders zijn gereset', 'flash_success');
		} else {
			$this->Session->setFlash('Startnrorder konden niet worden gereset', 'flash_error');
		}
		$this->redirect(array('action'=>'index'));
	}
	public function clearstage() {
		$this->loadModel('Stage');
		if( $this->Stage->deleteAll( array('Stage.id >'=>0) ) ){
			$this->Session->setFlash('Alle geplande beoordelingen zijn gewist', 'flash_success');
		} else {
			$this->Session->setFlash('De geplande beoordelingen konden niet worden gewist', 'flash_error');
		}
		$this->redirect( $this->referer()=="/" ? array('action'=>'index') : $this->referer() );
	}

	public function setRandomScores($contestId)
	{
		if (Configure::read('debug') < 2) {
			echo "Only available in debug mode";
			exit;
		}
		$this->loadModel('Contest');
		$this->loadModel('Round');
		$this->loadModel('Score');
		if (!$this->Contest->exists($contestId)) {
			throw new NotFoundException();
		}
		$contest = $this->Contest->findById($contestId);
		$scores = array();
		foreach ($contest['Point'] as $point) {
			foreach ($contest['Round'] as $round) {
				$round = $this->Round->findById($round['id']);
				foreach ($round['Contestant'] as $contestant) {
					foreach ($contest['User'] as $user) {
						$scores[] = array(
							'point_id' => $point['id'],
							'user_id' => $user['id'],
							'contestant_id' => $contestant['id'],
							'round_id' => $round['Round']['id'],
							'score' => rand(0, (int)$point['max']),
						);
					}
				}
			}
		}
		$roundIds = Set::extract('/Round/id', $contest);
		$this->Score->deleteAll(array('Score.round_id' => $roundIds));
		$this->Score->saveAll($scores, array('validate' => false));
		echo "Done";
		$this->redirect(array('action'=>'index'));
	}
}
?>