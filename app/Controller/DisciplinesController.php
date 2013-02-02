<?php
class DisciplinesController extends AppController {

	public $helpers = array('Sortable');

	public function index() {
		$this->Discipline->recursive = 0;
		$this->set('disciplines', $this->Discipline->find('all', array(
			'order' => array('Discipline.order' => 'asc'),
			'conditions' => array('Discipline.id >' => 0)
		)));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Discipline->create();
			if ($this->Discipline->save($this->request->data)) {
				$this->Session->setFlash('De discipline is opgeslaan', 'flash_succes');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('De discipline kon niet worden opgeslaan', 'flash_error');
			}
		}
	}

	public function edit($id = null) {
		if (!$this->Discipline->exists($id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Discipline->save($this->request->data)) {
				$this->Session->setFlash('De discipline is opgeslaan', 'flash_succes');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('De discipline kon niet worden opgeslaan', 'flash_error');
			}
		} else {
			$this->Discipline->id = $id;
			$this->request->data = $this->Discipline->read();
		}
	}

	public function delete($id = null) {
		if (!$this->Discipline->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');
		if ($this->Discipline->delete($id)) {
			$this->Session->setFlash('De discipline is verwijderd', 'flash_info');
		} else {
			$this->Session->setFlash('De discipline kon niet worden verwijderd', 'flash_error');
		}
		$this->redirect(array('action'=>'index'));
	}

	public function reorder(){
		$this->request->onlyAllow('post');
		foreach ($this->data['Discipline'] as $key => $value) {
			$this->Discipline->id = $value;
			$this->Discipline->saveField("order", $key+1);
		}
		exit();
	}
}
?>