<?php
App::uses('AppController', 'Controller');
/**
 * Adminscores Controller
 *
 * @property Adminscore $Adminscore
 */
class AdminscoresController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Adminscore->recursive = 0;
		$this->set('adminscores', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Adminscore->exists($id)) {
			throw new NotFoundException(__('Invalid adminscore'));
		}
		$options = array('conditions' => array('Adminscore.' . $this->Adminscore->primaryKey => $id));
		$this->set('adminscore', $this->Adminscore->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Adminscore->create();
			if ($this->Adminscore->save($this->request->data)) {
				$this->Session->setFlash(__('The adminscore has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The adminscore could not be saved. Please, try again.'));
			}
		}
		$contestants = $this->Adminscore->Contestant->find('list');
		$rounds = $this->Adminscore->Round->find('list');
		$this->set(compact('contestants', 'rounds'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Adminscore->exists($id)) {
			throw new NotFoundException(__('Invalid adminscore'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Adminscore->save($this->request->data)) {
				$this->Session->setFlash(__('The adminscore has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The adminscore could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Adminscore.' . $this->Adminscore->primaryKey => $id));
			$this->request->data = $this->Adminscore->find('first', $options);
		}
		$contestants = $this->Adminscore->Contestant->find('list');
		$rounds = $this->Adminscore->Round->find('list');
		$this->set(compact('contestants', 'rounds'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Adminscore->id = $id;
		if (!$this->Adminscore->exists()) {
			throw new NotFoundException(__('Invalid adminscore'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Adminscore->delete()) {
			$this->Session->setFlash(__('Adminscore deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Adminscore was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
