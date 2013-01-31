<?php
App::uses('AppController', 'Controller');
/**
 * Divisions Controller
 *
 * @property Division $Division
 */
class DivisionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Division->recursive = 0;
		$this->set('divisions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Division->exists($id)) {
			throw new NotFoundException(__('Invalid division'));
		}
		$options = array('conditions' => array('Division.' . $this->Division->primaryKey => $id));
		$this->set('division', $this->Division->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Division->create();
			if ($this->Division->save($this->request->data)) {
				$this->Session->setFlash(__('The division has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The division could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Division->exists($id)) {
			throw new NotFoundException(__('Invalid division'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Division->save($this->request->data)) {
				$this->Session->setFlash(__('The division has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The division could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Division.' . $this->Division->primaryKey => $id));
			$this->request->data = $this->Division->find('first', $options);
		}
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
		$this->Division->id = $id;
		if (!$this->Division->exists()) {
			throw new NotFoundException(__('Invalid division'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Division->delete()) {
			$this->Session->setFlash(__('Division deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Division was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
