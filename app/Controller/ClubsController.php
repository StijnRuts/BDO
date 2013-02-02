<?php
class ClubsController extends AppController {

	public function index() {
		$this->Club->recursive = 0;
		$this->set('clubs', $this->Club->find('all', array(
			'order' => array('Club.name' => 'asc'),
			'conditions' => array('Club.id >' => 0)
		)));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Club->create();
			if ($this->Club->save($this->request->data)) {
				$this->Session->setFlash('De club is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('De club kon niet worden opgeslaan', 'flash_error');
			}
		}
	}

	public function edit($id = null) {
		if (!$this->Club->exists($id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Club->save($this->request->data)) {
				$this->Session->setFlash('De club is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('De club kon niet worden opgeslaan', 'flash_error');
			}
		} else {
			$this->Club->id = $id;
			$this->request->data = $this->Club->read();
		}
	}

	public function delete($id = null) {
		if (!$this->Club->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');
		if ($this->Club->delete($id)) {
			$this->Session->setFlash('De club is verwijderd', 'flash_info');
		} else {
			$this->Session->setFlash('De club kon niet worden verwijderd', 'flash_error');
		}
		$this->redirect(array('action'=>'index'));
	}
}
?>