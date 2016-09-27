<?php
class JuryController extends AppController {

  public $uses = null;

  public function beforeFilter() {
    parent::beforeFilter();

    $this->Auth->loginAction = array(
      'controller' => 'jury',
      'action' => 'select_pc',
    );

    $this->Auth->allow('select_pc', 'index', 'checkstage', 'checkstaged');

    $current_user = $this->Auth->user();
    if ($current_user && $current_user['role'] == 'jury') {
      $this->Auth->allow('startjudging', 'judge');
    }
  }

  public function select_pc() {
    if ($this->request->is('post')) {
      $this->Session->delete('Message.auth');
      $this->Session->write('PCnumber', intval($this->data['Session']['pc_number']));
      $this->redirect(array('action' => 'index'));
    }
  }

  public function index() {
    if (!$this->Session->check('PCnumber')) {
      $this->redirect(array('action' => 'select_pc'));
      exit;
    }
    if ($this->Session->check('round_id') && $this->Auth->user()) {
      $this->loadModel('Contestant');
      $this->loadModel('Round');
      $current_user = $this->Auth->user();
      $round_id = $this->Session->read('round_id');
      $this->Session->delete('round_id');
      if ($this->Round->exists($round_id)) {
        $this->Round->id = $round_id;
        $round = $this->Round->find('first', array(
          'conditions' => array('Round.id'=>$round_id),
          'contain' => array('Contestant'=>array('order'=>'startnrorder'))
        ));
        foreach ($round['Contestant'] as &$contestant) {
          $this->Contestant->id = $contestant['id'];
          $score = $this->Contestant->getScores($round_id);
          $juryscores = $score['scores'][$current_user['id']];
          $juryscores[-1] = isset($juryscores[-1]) ? $juryscores[-1] : 0;
          $contestant['score'] = $juryscores['total']-$juryscores[-1];
        } unset($contestant);
        $this->set('round', $round);
      }
    }
  }

  public function startjudging() {
    $this->loadModel('Stage');
    $current_user = $this->Auth->user();
    if(!$current_user) $this->redirect(array('action'=>'index'));
    $stage = $this->Stage->findByUser_id($current_user['id']);
    if(count($stage) == 0) $this->redirect(array('action'=>'index'));
    $this->redirect(array('action'=>'judge', $stage['Stage']['contestant_id'], $stage['Stage']['round_id']));
  }

  public function judge($contestant_id = null, $round_id = null) {
    $current_user = $this->Auth->user();
    $this->loadModel('Score');
    $this->loadModel('Stage');
    $this->loadModel('Contestant');
    $this->loadModel('Round');

    // redirect if not staged
		$stage = $this->Stage->find('first', array(
      'conditions' => array(
        'user_id' => $current_user['id'],
        'round_id' => $round_id,
        'contestant_id' => $contestant_id
      )
    ));
    if (count($stage) == 0 ) {
      $this->redirect(array('action'=>'index'));
    }

    if (!$this->Contestant->exists($contestant_id) || !$this->Round->exists($round_id)){
      //unstage and redirect
      $this->Stage->deleteAll(array(
        'contestant_id' => $contestant_id,
        'round_id' => $round_id,
        'user_id' => $current_user['id']
      ));
      $this->redirect(array('action'=>'index'));
    }
    $this->Contestant->id = $contestant_id;
    $this->set('contestant', $this->Contestant->read());

    // create empty score objects
    $scores = $this->Contestant->getScores($round_id);
    $this->Score->setEmptyScores($scores['points'], $round_id, $contestant_id, $current_user['id']);
    $scores = $this->Contestant->getScores($round_id);
    $this->set('scores', $scores);

    //load scores
    $this->Round->id = $round_id;
    $round = $this->Round->find('first', array(
      'conditions' => array('Round.id'=>$round_id),
      'contain' => array('Contestant'=>array('order'=>'startnrorder'))
    ));
    foreach($round['Contestant'] as &$contestant){
      $this->Contestant->id = $contestant['id'];
      $score = $this->Contestant->getScores($round_id);
      $juryscores = $score['scores'][$current_user['id']];
      $juryscores[-1] = isset($juryscores[-1]) ? $juryscores[-1] : 0;
      $contestant['score'] = $juryscores['total']-$juryscores[-1];
    } unset($contestant);
    $this->set('round', $round);

    // if post
    if ($this->request->is('post') || $this->request->is('put')) {
      // save data
      if($this->Score->saveAll($this->request->data['Score'])){
        $this->loadModel('Stage');
        // redirect before unstage, if score equals previous score in same round for same judge
        $otherscores = array();
        foreach($round['Contestant'] as $contestant) {
          if( $contestant['id'] != $contestant_id ) {
            array_push($otherscores, $contestant['score']);
          }
        }

        $this->Contestant->id = $contestant_id;
        $newscore = $this->Contestant->getScores($round_id);
        $newscore = $newscore['scores'][$current_user['id']]['total'];

        if( in_array($newscore, $otherscores) ) {
          $this->Session->setFlash("Deze score komt al voor", 'flash_error');
          $this->redirect('#');
        }
        // unstage
        $this->Stage->deleteAll(array(
          'contestant_id' => $contestant_id,
          'round_id' => $round_id,
          'user_id' => $current_user['id']
        ));
        //redirect
        $this->Session->write('round_id', $round_id);
        $this->redirect(array('action'=>'index'));
        //$this->Session->setFlash("De scores zijn opgeslaan", 'flash_success');
      }else{
        $submitted_values = $this->request->data['Score'];
        $this->Session->setFlash("Deze scores konden niet worden opgeslaan", 'flash_error');
      }
    }

    // load data
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

    // show submitted scores if validation failed
    if ($this->request->is('post') || $this->request->is('put')) {
      foreach($this->request->data['Score'] as $key=>&$score){
        if( isset($submitted_values[$key]['score']) ){
          $score['score'] = $submitted_values[$key]['score'];
        }
      }
    }
  }

  public function checkstage() {
    $this->checkStageWithConditions();
  }

  public function checkstaged($contestant_id = null, $round_id = null) {
    $this->checkStageWithConditions(array(
      'round_id' => $round_id,
      'contestant_id' => $contestant_id
    ));
  }

  private function checkStageWithConditions($conditions = array()) {
    $this->request->onlyAllow('ajax');
    $this->loadModel('Stage');
    $current_user = $this->Auth->user();

    if ($current_user) {
      $conditions['user_id'] = $current_user['id'];
      $stage = $this->Stage->find('first', array('conditions' => $conditions));
    } else {
      $stage = array();
    }

    echo json_encode(array(
      'user_id' => intval($current_user['id']),
      'stage' => (count($stage) > 0),
    ));
    exit;
  }
}
