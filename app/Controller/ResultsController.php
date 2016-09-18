<?php
class ResultsController extends AppController {

  public $components = array('RequestHandler', 'Majoriteit');

  function beforeFilter(){
    //$this->Auth->allow('index', 'results'); //uncomment to make result page world accessible
  }


  public function inifile() {
    return TMP."scorebord.ini";
  }

  public function index() {
    $this->showmessage("Welkom");
    $this->layout = 'results';
  }

  public function results() {
    $this->request->onlyAllow('ajax');

    $this->setLogos();

    $ini = parse_ini_file($this->inifile());
    switch($ini['type']){
      case 'contest': $this->contest_results($ini['id']); break;
      case 'round': $this->round_results($ini['id']); break;
      case 'contestant': $this->contestant_results($ini['id'], $ini['round_id']); break;
      case 'contestname': $this->contest_name($ini['id']); break;
      case 'roundname': $this->round_name($ini['id']); break;
      case 'contestantname': $this->contestant_name($ini['id'], $ini['round_id']); break;
      case 'majoriteit': $this->majoriteit_results($ini['id'], $ini['minplace']); break;
      case 'majoriteitstartnr': $this->majoriteit_startnr($ini['id'], $ini['startnr']); break;
      case 'contestantmajoriteit': $this->majoriteit_contestant($ini['id'], $ini['round_id']); break;
      case 'roundusers': $this->round_users($ini['id']); break;
      case 'message': $this->message($ini['message']); break;
      default: echo "Error"; break;
    }
  }

  private function setLogos()
  {
    $logos = Cache::read('logos');

    if ($logos === false) {
      $this->loadModel('ScoreboardImage');
      $logos = $this->ScoreboardImage->find('all', array(
        'order' => array('ScoreboardImage.order'),
        'limit' => 3,
      ));
      Cache::write('logos', $logos);
    }

    $this->set('logos', $logos);
  }

  private function message($message) {
    $this->set('message', $message);

    $this->layout = 'results_ajax';
    $this->render('message');
  }

  private function contest_results($id = null) {
    $this->loadModel('Contest');
    $this->loadModel('Contestant');
    if (!$this->Contest->exists($id)) throw new NotFoundException();
    $contest = $this->Contest->find('first', array(
      'conditions' => array('Contest.id'=>$id),
      'contain' => array(
        'Round'=>array('order'=>'order'),
        'Round.Contestant' => array('order'=>'Contestant.startnrorder', 'Club'),
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

    $this->layout = 'results_ajax';
    $this->render('contest_results');
  }

  private function round_results($id = null) {
    $this->loadModel('Round');
    $this->loadModel('Contestant');
    if (!$this->Round->exists($id)) throw new NotFoundException();
    $round = $this->Round->find('first', array(
      'conditions' => array('Round.id'=>$id),
      'contain' => array('Contestant'=>array('order'=>'startnrorder'), 'Contestant.Club', 'Category', 'Discipline', 'Division', 'Contest')
    ));
    foreach($round['Contestant'] as &$contestant){
      $this->Contestant->id = $contestant['id'];
      $contestant['scores'] = $this->Contestant->getScores($id);
    }
    $this->set('round', $round);

    $this->layout = 'results_ajax';
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

    $this->layout = 'results_ajax';
    $this->render('contestant_results');
  }

  private function _majoriteit_part($round_id) {
    $round = $this->Round->find('first', array(
      'conditions' => array('Round.id'=>$round_id),
      'contain' => array(
        'Category', 'Discipline', 'Division', 'Contest', 'Contestant.Club', 'Contestant',
        'User' => array('order' => array('order' => 'asc')),
      )
    ));
    foreach ($round['Contestant'] as &$contestant){
      $this->Contestant->id = $contestant['id'];
      $contestant['scores'] = $this->Contestant->getScores($round_id);
    }
    $this->set('round', $round);

    $contest = $this->Contest->find('first', array(
      'conditions' => array('Contest.id' => $round['Round']['contest_id']),
      'contain' => false,
    ));
    $this->set('contest', $contest);

    $users = $round['User'];
    $this->set('users', $users);

    $majoriteit = $this->Majoriteit->getMajoriteit($round['Contestant'], $users);
    return $majoriteit;
  }

  private function majoriteit_results($round_id = null, $minplace = null) {
    $this->loadModel('Contest');
    $this->loadModel('Round');
    $this->loadModel('Contestant');

    if (!$this->Round->exists($round_id)) throw new NotFoundException();
    $majoriteit = $this->_majoriteit_part($round_id);

    usort($majoriteit, function($a,$b){
      if ($a['place'] == $b['place']) return 0;
      return ($a['place'] < $b['place']) ? -1 : 1;
    });
    $this->set('majoriteit', $majoriteit);
    $this->set('minplace', $minplace);

    $this->layout = 'results_ajax';
    $this->render('majoriteit_results');
  }

  private function majoriteit_startnr($round_id = null, $startnr = null) {
    $this->loadModel('Contest');
    $this->loadModel('Round');
    $this->loadModel('Contestant');

    if (!$this->Round->exists($round_id)) throw new NotFoundException();
    $majoriteit = $this->_majoriteit_part($round_id);

    usort($majoriteit, function($a,$b){
      if ($a['startnrorder'] == $b['startnrorder']) return 0;
      return ($a['startnrorder'] < $b['startnrorder']) ? -1 : 1;
    });
    $this->set('majoriteit', $majoriteit);
    $this->set('startnr', $startnr);

    $this->layout = 'results_ajax';
    $this->render('majoriteit_startnr');
  }

  private function majoriteit_contestant($contestant_id = null, $round_id = null) {
    $this->loadModel('Contest');
    $this->loadModel('Round');
    $this->loadModel('Contestant');

    if (!$this->Round->exists($round_id)) throw new NotFoundException();
    if (!$this->Contestant->exists($contestant_id)) throw new NotFoundException();
    $majoriteit = $this->_majoriteit_part($round_id);

    $this->set('majoriteit', $majoriteit);
    $this->set('contestantid', $contestant_id);

    $this->layout = 'results_ajax';
    $this->render('majoriteit_contestant');
  }

  private function round_users($id = null) {
    $this->loadModel('Round');
    if (!$this->Round->exists($id)) throw new NotFoundException();

    $round = $this->Round->find('first', array(
      'conditions' => array('Round.id' => $id),
      'contain' => array(
        'Discipline', 'Category', 'Division',
        'User' => array('order' => array('order' => 'asc')),
      ),
    ));
    $this->set('round', $round);

    $this->layout = 'results_ajax';
    $this->render('round_users');
  }

  private function contest_name($id = null) {
    $this->loadModel('Contest');
    if (!$this->Contest->exists($id)) throw new NotFoundException();
    $contest = $this->Contest->find('first', array(  'conditions' => array('Contest.id'=>$id) ));
    $this->set('contest', $contest);

    $this->layout = 'results_ajax';
    $this->render('contest_name');
  }

  private function round_name($id = null) {
    $this->loadModel('Round');
    if (!$this->Round->exists($id)) throw new NotFoundException();
    $round = $this->Round->find('first', array(
      'conditions' => array('Round.id'=>$id),
      'contain' => array('Category', 'Discipline', 'Division', 'Contest')
    ));
    $this->set('round', $round);

    $this->layout = 'results_ajax';
    $this->render('round_name');
  }

  private function contestant_name($contestant_id = null, $round_id = null) {
    $this->loadModel('Contestant');
    $this->loadModel('Round');
    if (!$this->Contestant->exists($contestant_id)) throw new NotFoundException();
    if (!$this->Round->exists($round_id)) throw new NotFoundException();
    $this->Contestant->id = $contestant_id;
    $this->set('contestant', $this->Contestant->read());

    $this->layout = 'results_ajax';
    $this->render('contestant_name');
  }

  public function contest_print($id = null) {
    $this->loadModel('Contest');
    $this->loadModel('Contestant');
    if (!$this->Contest->exists($id)) throw new NotFoundException();
    $contest = $this->Contest->find('first', array(
      'conditions' => array('Contest.id'=>$id),
      'contain' => array(
        'Round'=>array('order'=>'order'), 'Round.Contestant', 'Round.Contestant.Club',
        'Round.Category', 'Round.Discipline','Round.Division'
      )
    ));
    foreach($contest['Round'] as &$round){
      foreach($round['Contestant'] as &$contestant){
        $this->Contestant->id = $contestant['id'];
        $contestant['scores'] = $this->Contestant->getScores($round['id']);
      }
      $round['Contestant'] = $this->computeRanks($round['Contestant']);
    }
    $this->set('contest', $contest);

    $this->layout = 'pdf/default';
    $this->response->type('pdf');
  }

  public function round_print($id = null) {
    $this->loadModel('Round');
    $this->loadModel('Contestant');
    if (!$this->Round->exists($id)) throw new NotFoundException();
    $round = $this->Round->find('first', array(
      'conditions' => array('Round.id'=>$id),
      'contain' => array('Contestant', 'Contestant.Club', 'Category', 'Discipline', 'Division', 'Contest')
    ));
    foreach($round['Contestant'] as &$contestant){
      $this->Contestant->id = $contestant['id'];
      $contestant['scores'] = $this->Contestant->getScores($id);
    }
    $round['Contestant'] = $this->computeRanks($round['Contestant']);
    $this->set('round', $round);

    $this->layout = 'pdf/default';
    $this->response->type('pdf');
  }

  public function contestant_print($contestant_id = null, $round_id = null) {
    $this->loadModel('Contestant');
    $this->loadModel('Round');
    if (!$this->Contestant->exists($contestant_id)) throw new NotFoundException();
    if (!$this->Round->exists($round_id)) throw new NotFoundException();
    $this->Contestant->id = $contestant_id;
    $this->Round->id = $round_id;
    $this->set('contestant', $this->Contestant->read());
    $this->set('round', $this->Round->read());
    $this->set('scores', $this->Contestant->getScores($round_id));

    $this->layout = 'pdf/default';
    $this->response->type('pdf');
  }

  public function majoriteit_print($round_id = null) {
    $this->loadModel('Contest');
    $this->loadModel('Round');
    $this->loadModel('Contestant');

    if (!$this->Round->exists($round_id)) throw new NotFoundException();

    $majoriteit = $this->_majoriteit_part($round_id);

    usort($majoriteit, function($a,$b){
      if ($a['place'] == $b['place']) return 0;
      return ($a['place'] < $b['place']) ? -1 : 1;
    });

    $this->set('majoriteit', $majoriteit);

    $this->layout = 'pdf/default';
    $this->response->type('pdf');
  }

  public function showmessage($message){
    $this->write_ini(array(
      'type' => "message",
      'message' => $message,
    ));
  }

  public function showcontest($id = null){
    $this->write_ini(array(
      'type' => "contest",
      'id' => $id,
    ));
    if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
  }

  public function showround($id = null){
    $this->write_ini(array(
      'type' => "round",
      'id' => $id,
    ));
    if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
  }

  public function showcontestant($id = null, $round_id = null){
    $this->write_ini(array(
      'type' => "contestant",
      'id' => $id,
      'round_id' => $round_id,
    ));
    if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
  }

  public function showcontestname($id = null){
    $this->write_ini(array(
      'type' => "contestname",
      'id' => $id,
    ));
    if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
  }

  public function showroundname($id = null){
    $this->write_ini(array(
      'type' => "roundname",
      'id' => $id,
    ));
    if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
  }

  public function showcontestantname($id = null, $round_id = null){
    $this->write_ini(array(
      'type' => "contestantname",
      'id' => $id,
      'round_id' => $round_id,
    ));
    if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
  }

  public function showmajoriteit($id = null, $minplace = null){
    $this->write_ini(array(
      'type' => "majoriteit",
      'id' => $id,
      'minplace' => $minplace,
    ));
    if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
  }

  public function showmajoriteitstartnr($id = null, $startnr = null){
    $this->write_ini(array(
      'type' => "majoriteitstartnr",
      'id' => $id,
      'startnr' => $startnr
    ));
    if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
  }

  public function showcontestantmajoriteit($id = null, $round_id = null){
    $this->write_ini(array(
      'type' => "contestantmajoriteit",
      'id' => $id,
      'round_id' => $round_id
    ));
    if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
  }

  public function showroundusers($id = null, $redirection = true){
    $this->write_ini(array(
      'type' => "roundusers",
      'id' => $id,
    ));
    if ($redirection) {
      if (!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
    }
  }

  private function write_ini($data) {
    $fh = fopen($this->inifile(), 'w');
    foreach($data as $key => $value) {
      fwrite($fh, $key."=".$value."\r\n");
    }
    fclose($fh);
  }


  private function computeRanks($contestants){
    if( count($contestants)==0 ) return;

    uasort($contestants, function($contestant_a, $contestant_b){
      $a = $contestant_a['scores']['total'];
      $b = $contestant_b['scores']['total'];
      if ($a == $b) return 0;
      return ($a < $b) ? 1 : -1;
    });

    $rank = 0;
    $first = reset($contestants);
    $score = $first['scores']['total'] + 1;
    foreach($contestants as &$contestant){
      if( $contestant['scores']['total']<$score ){
        $score = $contestant['scores']['total'];
        $rank++;
        $contestant['scores']['rank'] = $rank;
      } else {
        //$contestant['scores']['rank'] = $rank;
        $contestant['scores']['rank'] = 'ex-aequo';
      }
    }
    return $contestants;
  }

}
