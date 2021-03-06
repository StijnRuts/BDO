<?php
class DivisionsController extends AppController {

	public $helpers = array('Sortable');

	public function index() {
		$this->Division->recursive = 0;
		$this->set('divisions', $this->Division->find('all', array(
			'order' => array('Division.order' => 'asc'),
			'conditions' => array('Division.id >' => 1)
		)));
	}

	public function add() {
		if ($this->request->is('post')) {
			$maxorder = $this->Division->find('first', array('order'=>'order DESC'));
			$this->request->data['Division']['order'] = $maxorder['Division']['order']+1;

			$this->Division->create();
			if ($this->Division->save($this->request->data)) {
				$this->Session->setFlash('De divisie is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('De divisie kon niet worden opgeslaan', 'flash_error');
			}
		}
	}

	public function edit($id = null) {
		if (!$this->Division->exists($id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Division->save($this->request->data)) {
				$this->Session->setFlash('De divisie is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('De divisie kon niet worden opgeslaan', 'flash_error');
			}
		} else {
			$this->Division->id = $id;
			$this->request->data = $this->Division->read();
		}
	}

	public function delete($id = null) {
		if (!$this->Division->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');
		if ($this->Division->delete($id)) {
			$this->Session->setFlash('De divisie is verwijderd', 'flash_info');
		} else {
			$this->Session->setFlash('De divisie kon niet worden verwijderd', 'flash_error');
		}
		$this->redirect(array('action'=>'index'));
	}

	public function reorder(){
		$this->request->onlyAllow('post');
		foreach ($this->data['Division'] as $key => $value) {
			$this->Division->id = $value;
			$this->Division->saveField("order", $key+1);
		}
		exit();
	}
}
?>