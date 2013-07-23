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
				$this->Session->setFlash($this->request->data['Contestant']['name'].' opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'add'));
			} else {
				$this->Session->setFlash($this->request->data['Contestant']['name'].' kon niet worden opgeslaan', 'flash_error');
			}
		}
		$clubs = $this->Contestant->Club->find('list', array('order'=>array('Club.name'=>'asc')) );
		$disciplines = $this->Contestant->Discipline->find('list', array('order'=>array('Discipline.order'=>'asc')) );
		$categories = $this->Contestant->Category->find('list', array('order'=>array('Category.order'=>'asc')) );
		$divisions = $this->Contestant->Division->find('list', array('order'=>array('Division.order'=>'asc')) );
		$this->set(compact('clubs', 'disciplines', 'categories', 'divisions'));
	}

	public function edit($id = null) {
		if (!$this->Contestant->exists($id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			$referer = $this->request->data['Contestant']['referer'];
			unset($this->request->data['Contestant']['referer']);
			if ($this->Contestant->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['Contestant']['name'].' opgeslaan', 'flash_success');
				$this->redirect($referer);
			} else {
				$this->Session->setFlash($this->request->data['Contestant']['name'].' kon niet worden opgeslaan', 'flash_error');
			}
		} else {
			$this->Contestant->id = $id;
			$this->request->data = $this->Contestant->read();
		}
		$clubs = $this->Contestant->Club->find('list', array('order'=>array('Club.name'=>'asc')) );
		$disciplines = $this->Contestant->Discipline->find('list', array('order'=>array('Discipline.order'=>'asc')) );
		$categories = $this->Contestant->Category->find('list', array('order'=>array('Category.order'=>'asc')) );
		$divisions = $this->Contestant->Division->find('list', array('order'=>array('Division.order'=>'asc')) );
		$this->set(compact('clubs', 'disciplines', 'categories', 'divisions'));

		$referer = $this->referer()=="/" ? Router::url(array('action'=>'index')) : $this->referer();
		$this->request->data['Contestant']['referer'] = $referer;
		$this->set('referer', $referer);
	}

	public function delete($id = null) {
		if (!$this->Contestant->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');

		$options = array('conditions' => array('Contestant.' . $this->Contestant->primaryKey => $id));
		$contestant = $this->Contestant->find('first', $options);

		if ($this->Contestant->delete($id)) {
			$this->Session->setFlash($contestant['Contestant']['name'].' verwijderd', 'flash_info');
		} else {
			$this->Session->setFlash($contestant['Contestant']['name'].' kon niet worden verwijderd', 'flash_error');
		}
		$this->redirect(array('action'=>'index'));
	}
}
