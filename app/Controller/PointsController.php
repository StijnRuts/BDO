<?php
class PointsController extends AppController {

	public function index() {
		$this->Point->recursive = 0;
		$this->set('Points', $this->Point->find('threaded',array('order'=>'lft')));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Point->create();
			if($this->request->data['Point']['parent_id']=='0') $this->request->data['Point']['parent_id']=null;
			if ($this->Point->save($this->request->data)) {
				$this->Session->setFlash('Het beoordelingspunt is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Het beoordelingspunt kon niet worden opgeslaan', 'flash_error');
			}
		}
		$parents[0] = " - nieuw onderdeel - ";
		$list = $this->Point->generateTreeList(null,null,null,"* ");
		if($list) foreach ($list as $key=>$value)	$parents[$key] = $value;
		$this->set(compact('parents'));
	}

	public function edit($id = null) {
		if (!$this->Point->exists($id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->request->data['Point']['parent_id']=='0') $this->request->data['Point']['parent_id']=null;
			if ($this->Point->save($this->request->data)) {
				$this->Session->setFlash('Het beoordelingspunt is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Het beoordelingspunt kon niet worden opgeslaan', 'flash_error');
			}
		} else {
			$this->Point->id = $id;
			$this->request->data = $this->Point->read();
		}
		$parents[0] = " - nieuw onderdeel - ";
		$list = $this->Point->generateTreeList(null,null,null,"* ");
		if($list) foreach ($list as $key=>$value)	$parents[$key] = $value;
		$this->set(compact('parents'));
	}

	public function delete($id = null) {
		if (!$this->Point->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');
		if ($this->Point->removeFromTree($id,true)) {
			$this->Session->setFlash('Het beoordelingspunt is verwijderd', 'flash_info');
		} else {
			$this->Session->setFlash('Het beoordelingspunt kon niet worden verwijderd', 'flash_error');
		}
		$this->redirect(array('action'=>'index'));
	}

	function moveup($id = null) {
		if (!$this->Point->exists($id)) throw new NotFoundException();
		if(!$this->Point->moveUp($id)) $this->Session->setFlash('Dit beoordelingspunt kan niet verder naar boven worden verplaatst');
		$this->redirect(array('action'=>'index'));
	}

	function movedown($id = null) {
		if (!$this->Point->exists($id)) throw new NotFoundException();
		if(!$this->Point->moveDown($id)) $this->Session->setFlash('Dit beoordelingspunt kan niet verder naar onder worden verplaatst');
		$this->redirect(array('action'=>'index'));
	}
}
