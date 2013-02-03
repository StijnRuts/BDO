<?php
App::uses('AppController', 'Controller');
/**
 * Rounds Controller
 *
 * @property Round $Round
 */
class RoundsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Round->recursive = 0;
		$this->set('rounds', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Round->exists($id)) {
			throw new NotFoundException(__('Invalid round'));
		}
		$options = array('conditions' => array('Round.' . $this->Round->primaryKey => $id));
		$this->set('round', $this->Round->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Round->create();
			if ($this->Round->save($this->request->data)) {
				$this->Session->setFlash(__('The round has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The round could not be saved. Please, try again.'));
			}
		}
		$contests = $this->Round->Contest->find('list');
		$disciplines = $this->Round->Discipline->find('list');
		$categories = $this->Round->Category->find('list');
		$divisions = $this->Round->Division->find('list');
		$contestants = $this->Round->Contestant->find('list');
		$this->set(compact('contests', 'disciplines', 'categories', 'divisions', 'contestants'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Round->exists($id)) {
			throw new NotFoundException(__('Invalid round'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Round->save($this->request->data)) {
				$this->Session->setFlash(__('The round has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The round could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Round.' . $this->Round->primaryKey => $id));
			$this->request->data = $this->Round->find('first', $options);
		}
		$contests = $this->Round->Contest->find('list');
		$disciplines = $this->Round->Discipline->find('list');
		$categories = $this->Round->Category->find('list');
		$divisions = $this->Round->Division->find('list');
		$contestants = $this->Round->Contestant->find('list');
		$this->set(compact('contests', 'disciplines', 'categories', 'divisions', 'contestants'));
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
		$this->Round->id = $id;
		if (!$this->Round->exists()) {
			throw new NotFoundException(__('Invalid round'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Round->delete()) {
			$this->Session->setFlash(__('Round deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Round was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
