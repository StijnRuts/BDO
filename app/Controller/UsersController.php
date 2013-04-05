<?php
class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout');
	}

	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->User->find('all', array(
			'order' => array('User.role'=>'asc', 'User.username'=>'asc'),
		)));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('De gebruiker is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('De gebruiker kon niet worden opgeslaan', 'flash_error');
			}
		}
	}

	public function edit($id = null) {
		if (!$this->User->exists($id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->request->data['User']['password']=='') unset($this->request->data['User']['password']);
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
?>