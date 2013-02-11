<?php
class DefaultpointsController extends AppController {

	public function index() {
		$this->Defaultpoint->recursive = 0;
		$this->set('defaultpoints', $this->paginate());
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Defaultpoint->create();
			if ($this->Defaultpoint->save($this->request->data)) {
				$this->Session->setFlash('Het beoordelingspunt is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Het beoordelingspunt kon niet worden opgeslaan', 'flash_error');
			}
		}
	}

	public function edit($id = null) {
		if (!$this->Defaultpoint->exists($id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Defaultpoint->save($this->request->data)) {
				$this->Session->setFlash('Het beoordelingspunt is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Het beoordelingspunt kon niet worden opgeslaan', 'flash_error');
			}
		} else {
			$this->Defaultpoint->id = $id;
			$this->request->data = $this->Defaultpoint->read();
		}
	}

	public function delete($id = null) {
		if (!$this->Defaultpoint->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');
		if ($this->Defaultpoint->delete($id)) {
			$this->Session->setFlash('Het beoordelingspunt is verwijderd', 'flash_info');
		} else {
			$this->Session->setFlash('Het beoordelingspunt kon niet worden verwijderd', 'flash_error');
		}
		$this->redirect(array('action'=>'index'));
	}
}
