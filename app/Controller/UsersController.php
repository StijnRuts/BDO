<?php

class UsersController extends AppController {

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('login', 'logout');
  }

  public function index() {
    $this->User->recursive = 0;
    $users = $this->User->find('all');

    usort($users, function($a, $b) {
      if ($a['User']['role']=="admin" && $b['User']['role']!="admin") {
        return -1;
      }
      if ($a['User']['role']!="admin" && $b['User']['role']=="admin") {
        return 1;
      }
      $numberCmp = strnatcmp($a['User']['number'], $b['User']['number']);
      $nameCmp = strcmp($a['User']['username'], $b['User']['username']);
      return ($numberCmp!=0) ? $numberCmp : $nameCmp;
    });

    $this->set('users', $users);
  }

  public function add() {
    if ($this->request->is('post')) {
      if (!empty($this->request->data['User']['image']['tmp_name'])) {
        $images = $this->uploadFiles($this->request->data['User']['image'], 'users');
        $this->request->data['User']['image'] = $images[0];
      }
      $this->User->create();
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash('De gebruiker is opgeslaan', 'flash_success');
        $this->redirect(array('action'=>'index'));
      } else {
        $this->Session->setFlash('De gebruiker kon niet worden opgeslaan', 'flash_error');
      }
    }
    $this->render('edit');
  }

  public function edit($id = null) {
    if (!$this->User->exists($id)) {
      throw new NotFoundException();
    }
    if ($this->request->is('post') || $this->request->is('put')) {
      if (!empty($this->request->data['User']['image']['tmp_name'])) {
        $images = $this->uploadFiles($this->request->data['User']['image'], 'users');
        $this->request->data['User']['image'] = $images[0];
      } else {
        unset($this->request->data['User']['image']);
      }
      if ($this->request->data['User']['password']=='') {
        unset($this->request->data['User']['password']);
      }
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash('De gebruiker is opgeslaan', 'flash_success');
        $this->redirect(array('action'=>'index'));
      } else {
        $this->Session->setFlash('De gebruiker kon niet worden opgeslaan', 'flash_error');
      }
    } else {
      $this->User->id = $id;
      $this->request->data = $this->User->read();
    }
  }

  public function delete($id = null) {
    if (!$this->User->exists($id)) throw new NotFoundException();
    $this->request->onlyAllow('post', 'delete');
    if ($this->User->delete($id)) {
      $this->Session->setFlash('De gebruiker is verwijderd', 'flash_info');
    } else {
      $this->Session->setFlash('De gebruiker kon niet worden verwijderd', 'flash_error');
    }
    $this->redirect(array('action'=>'index'));
  }

  public function login() {
    if ($this->request->is('post')) {
       if ($this->Auth->login()) {
         $this->Session->delete('Message.auth');
        $this->redirect($this->Auth->redirect());
      } else {
        $this->Session->setFlash('Inloggen mislukt', 'flash_error');
      }
    }

    $this->User->recursive = 0;
    $usernames = array();
    $users = $this->User->find('all', array('order' => array('User.role'=>'asc', 'User.username'=>'asc') ));
    foreach($users as $user) $usernames[$user['User']['username']] = $user['User']['username'];
    $this->set('usernames', $usernames);
  }

  public function logout() {
    $this->Session->setFlash('U bent uitgelogd', 'flash_info');
    $this->redirect($this->Auth->logout());
  }
}
