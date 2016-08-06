<?php
class ContestsController extends AppController {

	public $helpers = array('Sortable');

	public function index() {
		$this->Contest->recursive = 0;
		$this->set('contests', $this->Contest->find('all', array(
			'order' => array('Contest.date' => 'asc'),
		)));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Contest->create();
			if ($this->Contest->save($this->request->data)) {
				$this->Contest->initPoints();
				$this->Contest->initUsers(); // @TODO, this is now part of Round
				$this->Session->setFlash('De wedstrijd is opgeslaan', 'flash_success');
				$this->Session->write('recent.contest', $this->Contest->getLastInsertID());
				$this->redirect(array('action'=>'index'));
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
				$this->Session->write('recent.contest', $id);
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('De wedstrijd kon niet worden opgeslaan', 'flash_error');
			}
		} else {
			$this->Contest->id = $id;
			$this->request->data = $this->Contest->read();
			$this->request->data['Contest']['date'] = $this->request->data['Contest']['USdate'];
		}
	}

	public function delete($id = null) {
		if (!$this->Contest->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contest->delete($id)) {
			$this->Session->setFlash('De wedstrijd is verwijderd', 'flash_info');
			if($this->Session->check('recent.contest')) $this->Session->delete('recent.contest');
		} else {
			$this->Session->setFlash('De wedstrijd kon niet worden verwijderd', 'flash_error');
		}
		$this->redirect(array('action'=>'index'));
	}
}
