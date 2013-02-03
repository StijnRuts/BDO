<?php
App::uses('AppController', 'Controller');
/**
 * Contests Controller
 *
 * @property Contest $Contest
 */
class ContestsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Contest->recursive = 0;
		$this->set('contests', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contest->exists($id)) {
			throw new NotFoundException(__('Invalid contest'));
		}
		$options = array('conditions' => array('Contest.' . $this->Contest->primaryKey => $id));
		$this->set('contest', $this->Contest->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contest->create();
			if ($this->Contest->save($this->request->data)) {
				$this->Session->setFlash(__('The contest has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contest could not be saved. Please, try again.'));
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
		if (!$this->Contest->exists($id)) {
			throw new NotFoundException(__('Invalid contest'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Contest->save($this->request->data)) {
				$this->Session->setFlash(__('The contest has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Contest.' . $this->Contest->primaryKey => $id));
			$this->request->data = $this->Contest->find('first', $options);
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
		$this->Contest->id = $id;
		if (!$this->Contest->exists()) {
			throw new NotFoundException(__('Invalid contest'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contest->delete()) {
			$this->Session->setFlash(__('Contest deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Contest was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
