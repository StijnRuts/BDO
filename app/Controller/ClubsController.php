<?php
App::uses('AppController', 'Controller');
/**
 * Clubs Controller
 *
 * @property Club $Club
 */
class ClubsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Club->recursive = 0;
		$this->set('clubs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Club->exists($id)) {
			throw new NotFoundException(__('Invalid club'));
		}
		$options = array('conditions' => array('Club.' . $this->Club->primaryKey => $id));
		$this->set('club', $this->Club->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Club->create();
			if ($this->Club->save($this->request->data)) {
				$this->Session->setFlash(__('The club has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club could not be saved. Please, try again.'));
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
		if (!$this->Club->exists($id)) {
			throw new NotFoundException(__('Invalid club'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Club->save($this->request->data)) {
				$this->Session->setFlash(__('The club has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Club.' . $this->Club->primaryKey => $id));
			$this->request->data = $this->Club->find('first', $options);
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
		$this->Club->id = $id;
		if (!$this->Club->exists()) {
			throw new NotFoundException(__('Invalid club'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Club->delete()) {
			$this->Session->setFlash(__('Club deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Club was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
