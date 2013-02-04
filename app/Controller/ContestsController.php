<?php
class ContestsController extends AppController {

	public $helpers = array('Sortable');

	public function index() {
		$this->Contest->recursive = 0;
		$this->set('contests', $this->Contest->find('all', array(
			'order' => array('Contest.date' => 'asc'),
		)));
	}

	public function rounds($id = null) {
		if (!$this->Contest->exists($id)) throw new NotFoundException();
		$this->set('contest', $this->Contest->find('first', array(
			'conditions' => array('Contest.id'=>$id),
			'contain' => array('Round' => array('order'=>'Round.order', 'Category', 'Discipline', 'Division'))
		)));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Contest->create();
			if ($this->Contest->save($this->request->data)) {
				$this->Session->setFlash('De wedstrijd is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'rounds', $this->Contest->id));
			} else {
				$this->Session->setFlash('De wedstrijd kon niet worden opgeslaan', 'flash_error');
			}
		}
	}

	public function edit($id = null) {
		if (!$this->Contest->exists($id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Contest->save($this->request->data)) {
				$this->Session->setFlash('De wedstrijd is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('De wedstrijd kon niet worden opgeslaan', 'flash_error');
			}
		} else {
			$this->Contest->id = $id;
			$this->request->data = $this->Contest->read();
		}
	}

	public function delete($id = null) {
		if (!$this->Contest->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contest->delete($id)) {
			$this->Session->setFlash('De wedstrijd is verwijderd', 'flash_info');
		} else {
			$this->Session->setFlash('De wedstrijd kon niet worden verwijderd', 'flash_error');
		}
		$this->redirect(array('action'=>'index'));
	}
}
