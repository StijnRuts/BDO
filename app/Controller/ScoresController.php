<?php
class ScoresController extends AppController {

	public function index() {
		$this->Score->recursive = 0;
		$this->set('scores', $this->Score->find('all'));
	}

	public function edit($id = null) {
		if (!$this->Score->exists($id)) throw new NotFoundException();
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

}
