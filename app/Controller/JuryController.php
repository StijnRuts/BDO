<?php
class JuryController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$current_user = $this->Auth->user();
		if($current_user['role']=='jury') $this->Auth->allow('index', 'startjudging', 'judge', 'checkstage', 'checkstaged');
	}

	public function index() {
		$this->loadModel('Contestant');
		$this->loadModel('Round');
		if($this->Session->check('round_id')) {
			$current_user = $this->Auth->user();
			$round_id = $this->Session->read('round_id');
			$this->Session->delete('round_id');
			if($this->Round->exists($round_id)) {
				$this->Round->id = $round_id;
				$round = $this->Round->find('first', array(
					'conditions' => array('Round.id'=>$round_id),
					'contain' => array('Contestant'=>array('order'=>'startnrorder'))
				));
				foreach($round['Contestant'] as &$contestant){
					$this->Contestant->id = $contestant['id'];
					$score = $this->Contestant->getScores($round_id);
					$juryscores = $score['scores'][$current_user['id']];
					$contestant['scores'] = $juryscores;
					$contestant['points'] = $score['points'];
					$contestant['maxtotal'] = $score['maxtotal'];
				} unset($contestant);
				$this->set('round', $round);
			}
		}
	}

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
		$this->loadModel('Stage');
		$this->loadModel('Comment');

		// redirect if not staged
		$staged = $this->Stage->find('first', array(
			'conditions' => array(
				'user_id' => $current_user['id'],
				'round_id' => $round_id,
				'contestant_id' => $contestant_id
			)
		));
		if (count($staged) == 0) {
			$this->redirect(array('action'=>'index'));
		}

		// if post
		if ($this->request->is('post') || $this->request->is('put')) {
			// save data
			if ($this->Score->saveAll($this->request->data['Score']) &&
				$this->Comment->saveAll($this->request->data['Comment'])
			) {
				$this->loadModel('Stage');
				// unstage
				$this->Stage->deleteAll(array(
					'contestant_id' => $contestant_id,
					'round_id' => $round_id,
					'user_id' => $current_user['id']
				));
				// redirect
				$this->Session->write('round_id', $round_id);
				$this->redirect(array('action' => 'index'));
				// $this->Session->setFlash("De scores zijn opgeslaan", 'flash_success');
			} else {
				$submitted_values = $this->request->data['Score'];
				$this->Session->setFlash("Deze scores konden niet worden opgeslaan", 'flash_error');
			}
		}

		$this->loadModel('Contestant');
		$this->loadModel('Round');
		if (!$this->Contestant->exists($contestant_id) || !$this->Round->exists($round_id)) {
			// unstage and redirect
			$this->Stage->deleteAll(array(
				'contestant_id' => $contestant_id,
				'round_id' => $round_id,
				'user_id' => $current_user['id'],
			));
			$this->redirect(array('action' => 'index'));
		}
		$this->Contestant->id = $contestant_id;
		$this->set('contestant', $this->Contestant->read());

		// create empty score objects
		$scores = $this->Contestant->getScores($round_id);
		$this->Score->setEmptyScores($scores['points'], $round_id, $contestant_id, $current_user['id']);
		$scores = $this->Contestant->getScores($round_id);
		$this->set('scores', $scores);

        // create empty comment
        $comment = $this->Comment->find('first', array(
            'conditions' => array(
                'user_id' => $current_user['id'],
                'contestant_id' => $contestant_id,
                'round_id' => $round_id,
            )
        ));
        if (!$comment) {
            $this->Comment->save(array(
                'user_id' => $current_user['id'],
                'contestant_id' => $contestant_id,
                'round_id' => $round_id,
                'comment' => '',
            ));
        }

		// load scores
		$this->Round->id = $round_id;
		$round = $this->Round->find('first', array(
			'conditions' => array('Round.id' => $round_id),
			'contain' => array('Contestant' => array('order' => 'startnrorder')),
		));
		foreach ($round['Contestant'] as &$contestant) {
			$this->Contestant->id = $contestant['id'];
			$score = $this->Contestant->getScores($round_id);
			$juryscores = $score['scores'][$current_user['id']];
			$contestant['scores'] = $juryscores;
		}
		$this->set('round', $round);

        // load data
        $scores = $this->Score->find('all', array(
            'conditions' => array(
                'user_id' => $current_user['id'],
                'contestant_id' => $contestant_id,
                'round_id' => $round_id,
            )
        ));
        $scores = Set::combine($scores, '{n}.Score.id', '{n}.Score');
        $comment = $this->Comment->find('first', array(
            'conditions' => array(
                'user_id' => $current_user['id'],
                'contestant_id' => $contestant_id,
                'round_id' => $round_id,
            )
        ));
        $this->request->data = array(
            'Score' => $scores,
            'Comment' => $comment['Comment'],
        );

		// show submitted scores if validation failed
		if ($this->request->is('post') || $this->request->is('put')) {
			foreach ($this->request->data['Score'] as $key => &$score) {
				if (isset($submitted_values[$key]['score'])) {
					$score['score'] = $submitted_values[$key]['score'];
				}
			}
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
	public function checkstaged($contestant_id = null, $round_id = null) {
		$this->request->onlyAllow('ajax');
		$this->loadModel('Stage');
		$current_user = $this->Auth->user();
		$stage = $this->Stage->find('first', array(
			'conditions' => array(
				'user_id' => $current_user['id'],
				'round_id' => $round_id,
				'contestant_id' => $contestant_id
			)
		));
		echo ( count($stage)>0 );
		exit();
	}

}
?>