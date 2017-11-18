<?php
class RoundsController extends AppController {

  public function index() {
    //if recent contest is set => redirect
    if($this->Session->check('recent.contest')) $this->redirect(array('action'=>'view', $this->Session->read('recent.contest')));

    //otherwise, redirect to first contest
    $this->loadModel('Contest');
    $this->Contest->recursive = 0;
    $contests = $this->Contest->find('all', array(
      'order' => array('Contest.date' => 'asc')
    ));
    if( isset($contests[0]) ){
      $this->redirect( array('action'=>'view', $contests[0]['Contest']['id']) );
    } else {
      exit();
    }
  }

  public function view($contest_id = null) {
    $this->loadModel('Contest');
    if (!$this->Contest->exists($contest_id)) throw new NotFoundException();
    $this->Session->write('recent.contest', $contest_id);
    $this->set('contest', $this->Contest->find('first', array(
      'conditions' => array('Contest.id'=>$contest_id),
      'contain' => array('Round' => array('order'=>'Round.order', 'Category', 'Discipline', 'Division'))
    )));

    $this->set('contests', $this->Contest->find('all', array(
      'order' => array('Contest.date' => 'asc'),
    )));
  }

  public function add($contest_id = null) {
    $this->loadModel('Contest');
    if(!$this->Contest->exists($contest_id)) throw new NotFoundException();
    if ($this->request->is('post')) {
      $maxorder = $this->Round->find('first', array(
        'order'=>'Round.order DESC',
        'conditions' => array('Contest.id' => $this->request->data['Round']['contest_id'])
      ));
      $this->request->data['Round']['order'] = $maxorder['Round']['order']+1;

      $this->Round->create();
      if ($this->Round->save($this->request->data)) {
        $this->Round->initUsers();
        $this->Session->setFlash('De ronde is opgeslaan', 'flash_success');
        $this->redirect(array('action'=>'view', $this->request->data['Round']['contest_id']));
      } else {
        $this->Session->setFlash('De ronde kon niet worden opgeslaan', 'flash_error');
      }
    }
    $contests = $this->Round->Contest->find('list', array('order'=>array('Contest.date'=>'asc')) );
    $disciplines = $this->Round->Discipline->find('list', array('order'=>array('Discipline.order'=>'asc')) );
    $categories = $this->Round->Category->find('list', array('order'=>array('Category.order'=>'asc')) );
    $divisions = $this->Round->Division->find('list', array('order'=>array('Division.order'=>'asc')) );
    $this->set(compact('contests', 'disciplines', 'categories', 'divisions'));
    $this->set('contest_id', $contest_id);
  }

  public function edit($id = null) {
    if (!$this->Round->exists($id)) throw new NotFoundException();
    if ($this->request->is('post') || $this->request->is('put')) {
      if ($this->Round->save($this->request->data)) {
        $this->Session->setFlash('De ronde is opgeslaan', 'flash_success');
        $this->redirect(array('action'=>'view', $this->request->data['Round']['contest_id']));
      } else {
        $this->Session->setFlash('De ronde kon niet worden opgeslaan', 'flash_error');
      }
    } else {
      $this->Round->id = $id;
      $this->request->data = $this->Round->read();
    }
    $contests = $this->Round->Contest->find('list', array('order'=>array('Contest.date'=>'asc')) );
    $disciplines = $this->Round->Discipline->find('list', array('order'=>array('Discipline.order'=>'asc')) );
    $categories = $this->Round->Category->find('list', array('order'=>array('Category.order'=>'asc')) );
    $divisions = $this->Round->Division->find('list', array('order'=>array('Division.order'=>'asc')) );
    $this->set(compact('contests', 'disciplines', 'categories', 'divisions'));
  }

  public function delete($id = null) {
    if (!$this->Round->exists($id)) throw new NotFoundException();
    $this->request->onlyAllow('post', 'delete');
    $this->Round->id = $id;
    $round = $this->Round->read();
    if ($this->Round->delete($id)) {
      $this->Session->setFlash('De ronde is verwijderd', 'flash_info');
      if($this->Session->check('recent.round')) $this->Session->delete('recent.round');
    } else {
      $this->Session->setFlash('De ronde kon niet worden verwijderd', 'flash_error');
    }
    $this->redirect(array('action'=>'view', $round['Contest']['id']));
  }

  public function reorder(){
    $this->request->onlyAllow('post');
    foreach ($this->data['Round'] as $key => $value) {
      $this->Round->id = $value;
      $this->Round->saveField("order", $key+1);
    }
    exit();
  }

  public function contestants($id = null) {
    $this->loadModel('ContestantsRound');
    if (!$this->Round->exists($id)) throw new NotFoundException();
    $this->Round->id = $id;
    $round = $this->Round->read();

    if ($this->request->is('post') || $this->request->is('put')) {
      $this->request->data['Round'] = array('id'=>$id);
      if(!isset($this->request->data['Contestant'])) $this->request->data['Contestant'] = array('Contestant'=>'');

      $this->ContestantsRound->deleteAll(array('round_id'=>$id));
      foreach($this->request->data['Contestant'] as $contestant){
        $this->request->data['ContestantsRound'][] = array('round_id'=>$id, 'contestant_id'=>$contestant);
      }

      if ($this->request->data['generate_startnrs']) {
          $contestants = array_values($this->request->data['Contestant']);
          shuffle($contestants);
          array_walk($contestants, function (&$item, $startnr) {
              $item = array(
                  'id' => $item,
                  'startnr' => $startnr + 1,
              );
          });

          $this->loadModel('Contestant');
          $this->Contestant->saveAll($contestants);
      }

      unset($this->request->data['Contestant']);
      unset($this->request->data['Round']);

      if ($this->ContestantsRound->saveMany($this->request->data['ContestantsRound'])) {
        $this->Session->setFlash('De deelnemerlijst is opgeslaan', 'flash_success');
        $this->redirect(array('action'=>'view', $round['Round']['contest_id']));
      } else {
        $this->Session->setFlash('De deelnemerlijst kon niet worden opgeslaan', 'flash_error');
      }
    }

    $this->loadModel('Contestant');
    $this->Contestant->recursive = 0;
    $this->set('contestants', $this->Contestant->find('all'));
    $this->set('round', $round);

    $selected = array();
    foreach($round['Contestant'] as $contestant) $selected[] = $contestant['id'];
    $this->set('selected', $selected);

    $this->set('rounds', $this->Round->find('all', array(
      'conditions' => array('contest_id'=>$round['Round']['contest_id']),
      'order' => 'Round.order',
      'contain' => array('Category', 'Discipline', 'Division')
    )));
  }

  public function users($id = null)
  {
    $this->loadModel('User');
    if (!$this->Round->exists($id)) {
      throw new NotFoundException();
    }

    $round = $this->Round->find('first', array(
      'conditions' => array('Round.id' => $id),
      'contain' => array(
        'Discipline', 'Category', 'Division',
        'User' => array('order' => array('order' => 'asc')),
      ),
    ));
    $this->set('round', $round);

    if ($this->request->is('post') || $this->request->is('put')) {
      $users = json_decode($this->request->data['Round']['User']);

      $roundsUsers = array();
      foreach ($users as $key => $user_id) {
        $roundsUsers[] = array(
          'round_id' => $id,
          'user_id' => $user_id,
          'order' => $key,
        );
      }

      $this->loadModel('RoundsUser');

      if (
        $this->RoundsUser->deleteAll(array('RoundsUser.round_id' => $id)) &&
        (empty($roundsUsers) || $this->RoundsUser->saveAll($roundsUsers))
      ) {

        if ($this->data['type'] == 'show_results') {
          App::import('Controller', 'Results');
          $Results = new ResultsController;
          $Results->showroundusers($id, false);
          $this->redirect(array('action'=>'users', $id));
        }

        if ($this->data['type'] == 'login_jury') {
          if ($this->loginJury($users)) {
            $this->Session->setFlash('De juryleden zijn ingelogd', 'flash_success');
          } else {
            $this->Session->setFlash('De juryleden konden niet worden ingelogd', 'flash_error');
          }
          $this->redirect(array('action'=>'users', $id));
        }
        if ($this->data['type'] == 'logout_jury') {
          if ($this->logoutJury()) {
            $this->Session->setFlash('De juryleden zijn uitgelogd', 'flash_success');
          } else {
            $this->Session->setFlash('De juryleden konden niet worden uitgelogd', 'flash_error');
          }
          $this->redirect(array('action'=>'users', $id));
        }

        $this->Session->setFlash('De jurysamenstelling is opgeslaan', 'flash_success');
        $this->redirect(array('action'=>'view', $round['Round']['contest_id']));
      } else {
        $this->Session->setFlash('De jurysamenstelling kon niet worden opgeslaan', 'flash_error');
      }
    } else {
      $this->Round->id = $id;
      $this->request->data = $this->Round->read();
    }

    $rounds = $this->Round->find('all', array(
      'conditions' => array('contest_id' => $round['Round']['contest_id']),
      'order' => 'Round.order',
      'contain' => array('Category', 'Discipline', 'Division')
    ));
    $this->set('rounds', $rounds);

    $users = $this->Round->User->find('all', array(
      'conditions' => array('role' => 'jury'),
    ));
    usort($users, array($this->User, 'cmp'));
    $this->set('users', $users);

    $selected = Set::extract('/User/id', $round);
    $this->set('selected', $selected);
  }

  private function loginJury($userIds)
  {
    $this->loadModel('User');
    $this->User->recursive = -1;
    $users = $this->User->findAllById($userIds);
    $users = Set::combine($users, '/User/id', '/User');

    $this->loadModel('CustomSession');
    $sessions = $this->CustomSession->find('all');

    $sessions = array_map(function($session) use ($userIds, $users) {
      if (isset($session['CustomSession']['data']['PCnumber'])) {
        $PCnumber = $session['CustomSession']['data']['PCnumber'];
        $userId = $userIds[$PCnumber - 1];
        if (isset($users[$userId])) {
          $session['CustomSession']['data']['Auth']['User'] = $users[$userId]['User'];
        } else {
          unset($session['CustomSession']['data']['Auth']);
        }
      }
      return $session;
    }, $sessions);

    return $this->CustomSession->saveAll($sessions);
  }

  private function logoutJury()
  {
    $this->loadModel('CustomSession');
    $sessions = $this->CustomSession->find('all');

    $sessions = array_map(function($session) {
      if ($session['CustomSession']['data']['Auth']['User']['role'] != 'admin') {
        unset($session['CustomSession']['data']['Auth']);
      }
      return $session;
    }, $sessions);

    return $this->CustomSession->saveAll($sessions);
  }
}
