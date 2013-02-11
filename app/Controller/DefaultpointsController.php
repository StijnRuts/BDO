<?php
class DefaultpointsController extends AppController {

	public function index() {
		$this->Defaultpoint->recursive = 0;
		$this->set('defaultpoints', $this->Defaultpoint->find('threaded',array('order'=>'lft')));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Defaultpoint->create();
			if($this->request->data['Defaultpoint']['parent_id']=='0') $this->request->data['Defaultpoint']['parent_id']=null;
			if ($this->Defaultpoint->save($this->request->data)) {
				$this->Session->setFlash('Het beoordelingspunt is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Het beoordelingspunt kon niet worden opgeslaan', 'flash_error');
			}
		}
		$parents[0] = " - nieuw onderdeel - ";
		$list = $this->Defaultpoint->generateTreeList(null,null,null,"* ");
		if($list) foreach ($list as $key=>$value)	$parents[$key] = $value;
		$this->set(compact('parents'));
	}

	public function edit($id = null) {
		if (!$this->Defaultpoint->exists($id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->request->data['Defaultpoint']['parent_id']=='0') $this->request->data['Defaultpoint']['parent_id']=null;
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
		$parents[0] = " - nieuw onderdeel - ";
		$list = $this->Defaultpoint->generateTreeList(null,null,null,"* ");
		if($list) foreach ($list as $key=>$value)	$parents[$key] = $value;
		$this->set(compact('parents'));
	}

	public function delete($id = null) {
		if (!$this->Defaultpoint->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');
		if ($this->Defaultpoint->removeFromTree($id,true)) {
			$this->Session->setFlash('Het beoordelingspunt is verwijderd', 'flash_info');
		} else {
			$this->Session->setFlash('Het beoordelingspunt kon niet worden verwijderd', 'flash_error');
		}
		$this->redirect(array('action'=>'index'));
	}

	function moveup($id = null) {
		if (!$this->Defaultpoint->exists($id)) throw new NotFoundException();
		if(!$this->Defaultpoint->moveUp($id)) $this->Session->setFlash('Dit beoordelingspunt kan niet verder naar boven worden verplaatst');
		$this->redirect(array('action'=>'index'));
	}

	function movedown($id = null) {
		if (!$this->Defaultpoint->exists($id)) throw new NotFoundException();
		if(!$this->Defaultpoint->moveDown($id)) $this->Session->setFlash('Dit beoordelingspunt kan niet verder naar onder worden verplaatst');
		$this->redirect(array('action'=>'index'));
	}
}
