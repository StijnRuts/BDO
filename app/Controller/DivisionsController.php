<?php
class DivisionsController extends AppController {

	public $helpers = array('Sortable');

	public function index() {
		$this->Division->recursive = 0;
		$this->set('divisions', $this->Division->find('all', array(
			'order' => array('Division.order' => 'asc'),
			'conditions' => array('Division.id >' => 0)
		)));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Division->create();
			if ($this->Division->save($this->request->data)) {
				$this->Session->setFlash('De divisie is opgeslaan');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('De divisie kon niet worden opgeslaan');
			}
		}
	}

	public function edit($id = null) {
		if (!$this->Division->exists($id)) throw new NotFoundException('De opgegeven divisie kan niet worden gevonden');
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Division->save($this->request->data)) {
				$this->Session->setFlash('De divisie is opgeslaan');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('De divisie kon niet worden opgeslaan');
			}
		} else {
			$this->Division->id = $id;
			$this->request->data = $this->Division->read();
		}
	}

	public function delete($id = null) {
		if (!$this->Division->exists($id)) throw new NotFoundException('De opgegeven divisie kan niet worden gevonden');
		$this->request->onlyAllow('post', 'delete');
		if ($this->Division->delete($id)) {
			$this->Session->setFlash('De divisie is verwijderd');
		} else {
			$this->Session->setFlash('De divisie kon niet worden verwijderd');
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