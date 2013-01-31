<?php
App::uses('AppController', 'Controller');
/**
 * Contestants Controller
 *
 * @property Contestant $Contestant
 */
class ContestantsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Contestant->recursive = 0;
		$this->set('contestants', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contestant->exists($id)) {
			throw new NotFoundException(__('Invalid contestant'));
		}
		$options = array('conditions' => array('Contestant.' . $this->Contestant->primaryKey => $id));
		$this->set('contestant', $this->Contestant->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contestant->create();
			if ($this->Contestant->save($this->request->data)) {
				$this->Session->setFlash(__('The contestant has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contestant could not be saved. Please, try again.'));
			}
		}
		$clubs = $this->Contestant->Club->find('list');
		$disciplines = $this->Contestant->Discipline->find('list');
		$categories = $this->Contestant->Category->find('list');
		$divisions = $this->Contestant->Division->find('list');
		$this->set(compact('clubs', 'disciplines', 'categories', 'divisions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Contestant->exists($id)) {
			throw new NotFoundException(__('Invalid contestant'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Contestant->save($this->request->data)) {
				$this->Session->setFlash(__('The contestant has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contestant could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Contestant.' . $this->Contestant->primaryKey => $id));
			$this->request->data = $this->Contestant->find('first', $options);
		}
		$clubs = $this->Contestant->Club->find('list');
		$disciplines = $this->Contestant->Discipline->find('list');
		$categories = $this->Contestant->Category->find('list');
		$divisions = $this->Contestant->Division->find('list');
		$this->set(compact('clubs', 'disciplines', 'categories', 'divisions'));
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
		$this->Contestant->id = $id;
		if (!$this->Contestant->exists()) {
			throw new NotFoundException(__('Invalid contestant'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contestant->delete()) {
			$this->Session->setFlash(__('Contestant deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Contestant was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
