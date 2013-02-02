<?php
class CategoriesController extends AppController {

	public $helpers = array('Sortable');

	public function index() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->Category->find('all', array(
			'order' => array('Category.order' => 'asc'),
			'conditions' => array('Category.id >' => 0)
		)));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			$this->request->data['Category']['order'] = $this->Category->find('count');
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash('De categorie is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('De categorie kon niet worden opgeslaan', 'flash_error');
			}
		}
	}

	public function edit($id = null) {
		if (!$this->Category->exists($id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash('De categorie is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('De categorie kon niet worden opgeslaan', 'flash_error');
			}
		} else {
			$this->Category->id = $id;
			$this->request->data = $this->Category->read();
		}
	}

	public function delete($id = null) {
		if (!$this->Category->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');
		if ($this->Category->delete($id)) {
			$this->Session->setFlash('De categorie is verwijderd', 'flash_info');
		} else {
			$this->Session->setFlash('De categorie kon niet worden verwijderd', 'flash_error');
		}
		$this->redirect(array('action'=>'index'));
	}

	public function reorder(){
		$this->request->onlyAllow('post');
		foreach ($this->data['Category'] as $key => $value) {
			$this->Category->id = $value;
			$this->Category->saveField("order", $key+1);
		}
		exit();
	}
}
?>