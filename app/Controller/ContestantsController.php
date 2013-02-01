<?php
class ContestantsController extends AppController {

	public function index() {
		$this->Contestant->recursive = 0;
		$this->set('contestants', $this->Contestant->find('all'));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Contestant->create();
			if ($this->Contestant->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['Contestant']['name'].' opgeslaan');
				$this->redirect(array('action'=>'add'));
			} else {
				$this->Session->setFlash($this->request->data['Contestant']['name'].' kon niet worden opgeslaan');
			}
		}
		$clubs = $this->Contestant->Club->find('list');
		$disciplines = $this->Contestant->Discipline->find('list');
		$categories = $this->Contestant->Category->find('list');
		$divisions = $this->Contestant->Division->find('list');
		$this->set(compact('clubs', 'disciplines', 'categories', 'divisions'));
	}

	public function edit($id = null) {
		if (!$this->Contestant->exists($id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Contestant->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['Contestant']['name'].' opgeslaan');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash($this->request->data['Contestant']['name'].' kon niet worden opgeslaan');
			}
		} else {
			$this->Contestant->id = $id;
			$this->request->data = $this->Contestant->read();
		}
		$clubs = $this->Contestant->Club->find('list');
		$disciplines = $this->Contestant->Discipline->find('list');
		$categories = $this->Contestant->Category->find('list');
		$divisions = $this->Contestant->Division->find('list');
		$this->set(compact('clubs', 'disciplines', 'categories', 'divisions'));
	}

	public function delete($id = null) {
		if (!$this->Contestant->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');

		$options = array('conditions' => array('Contestant.' . $this->Contestant->primaryKey => $id));
		$contestant = $this->Contestant->find('first', $options);

		if ($this->Contestant->delete($id)) {
			$this->Session->setFlash($contestant['Contestant']['name'].' verwijderd');
		} else {
			$this->Session->setFlash($contestant['Contestant']['name'].' kon niet worden verwijderd');
		}
		$this->redirect(array('action'=>'index'));
	}
}
