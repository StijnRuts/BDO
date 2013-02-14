<?php
class ScoresController extends AppController {

	public function index() {
		$this->Score->recursive = 0;
		$this->set('scores', $this->paginate());
	}

	public function view($id = null) {
		if (!$this->Score->exists($id)) {
			throw new NotFoundException(__('Invalid score'));
		}
		$options = array('conditions' => array('Score.' . $this->Score->primaryKey => $id));
		$this->set('score', $this->Score->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Score->create();
			if ($this->Score->save($this->request->data)) {
				$this->Session->setFlash(__('The score has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The score could not be saved. Please, try again.'));
			}
		}
		$points = $this->Score->Point->find('list');
		$users = $this->Score->User->find('list');
		$contestants = $this->Score->Contestant->find('list');
		$this->set(compact('points', 'users', 'contestants'));
	}

	public function edit($id = null) {
		if (!$this->Score->exists($id)) {
			throw new NotFoundException(__('Invalid score'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Score->save($this->request->data)) {
				$this->Session->setFlash(__('The score has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The score could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Score.' . $this->Score->primaryKey => $id));
			$this->request->data = $this->Score->find('first', $options);
		}
		$points = $this->Score->Point->find('list');
		$users = $this->Score->User->find('list');
		$contestants = $this->Score->Contestant->find('list');
		$this->set(compact('points', 'users', 'contestants'));
	}

	public function delete($id = null) {
		$this->Score->id = $id;
		if (!$this->Score->exists()) {
			throw new NotFoundException(__('Invalid score'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Score->delete()) {
			$this->Session->setFlash(__('Score deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Score was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
