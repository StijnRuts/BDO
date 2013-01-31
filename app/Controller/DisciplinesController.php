<?php
App::uses('AppController', 'Controller');
/**
 * Disciplines Controller
 *
 * @property Discipline $Discipline
 */
class DisciplinesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Discipline->recursive = 0;
		$this->set('disciplines', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Discipline->exists($id)) {
			throw new NotFoundException(__('Invalid discipline'));
		}
		$options = array('conditions' => array('Discipline.' . $this->Discipline->primaryKey => $id));
		$this->set('discipline', $this->Discipline->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Discipline->create();
			if ($this->Discipline->save($this->request->data)) {
				$this->Session->setFlash(__('The discipline has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The discipline could not be saved. Please, try again.'));
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
		if (!$this->Discipline->exists($id)) {
			throw new NotFoundException(__('Invalid discipline'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Discipline->save($this->request->data)) {
				$this->Session->setFlash(__('The discipline has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The discipline could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Discipline.' . $this->Discipline->primaryKey => $id));
			$this->request->data = $this->Discipline->find('first', $options);
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
		$this->Discipline->id = $id;
		if (!$this->Discipline->exists()) {
			throw new NotFoundException(__('Invalid discipline'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Discipline->delete()) {
			$this->Session->setFlash(__('Discipline deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Discipline was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
