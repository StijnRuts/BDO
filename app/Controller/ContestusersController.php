<?php

class ContestusersController extends AppController
{
  public function index()
  {
    // if recent contest is set => redirect
    if ($this->Session->check('recent.contest')) {
      $this->redirect(array('action'=>'edit', $this->Session->read('recent.contest')));
    }

    // otherwise, redirect to first contest
    $this->loadModel('Contest');
    $this->Contest->recursive = 0;
    $contests = $this->Contest->find('all', array(
      'order' => array('Contest.date' => 'asc')
    ));
    if (isset($contests[0])) {
      $this->redirect(array('action'=>'edit', $contests[0]['Contest']['id']));
    } else {
      exit();
    }
  }

  public function edit($contest_id = null)
  {
    $this->loadModel('Contest');
    if (!$this->Contest->exists($contest_id)) {
      throw new NotFoundException();
    }

    if ($this->request->is('post') || $this->request->is('put')) {
      $users = json_decode($this->request->data['Contest']['User']);

      $contestsUser = array();
      foreach ($users as $key => $user_id) {
        $contestsUser[] = array(
          'contest_id' => $contest_id,
          'user_id' => $user_id,
          'order' => $key,
        );
      }

      $this->loadModel('ContestsUser');

      if (
        $this->ContestsUser->deleteAll(array('contest_id' => $contest_id)) &&
        $this->ContestsUser->saveAll($contestsUser)
      ) {
        $this->Session->setFlash('De jurysamenstelling is opgeslaan', 'flash_success');
        $this->Session->write('recent.contest', $contest_id);
        $this->redirect(array('controller'=>'contests', 'action'=>'index'));
      } else {
        $this->Session->setFlash('De jurysamenstelling kon niet worden opgeslaan', 'flash_error');
      }
    } else {
      $this->Contest->id = $contest_id;
      $this->request->data = $this->Contest->read();
    }

    $contest = $this->Contest->find('first', array(
      'conditions' => array('Contest.id' => $contest_id),
      'contain' => array(
        'User' => array('order' => array('order' => 'asc')),
      ),
    ));
    $this->set('contest', $contest);

    $contests = $this->Contest->find('all', array(
      'order' => array('Contest.date' => 'asc'),
    ));
    $this->set('contests', $contests);

    $users = $this->Contest->User->find('all', array(
      'conditions' => array('role' => 'jury'),
      'order' => array('username' => 'asc'),
    ));
    $this->set('users', $users);

    $selected = Set::extract('/User/id', $contest);
    $this->set('selected', $selected);
  }
}
