<?php
class PointsController extends AppController {

	public function index() {
		//if recent contest is set => redirect
		if($this->Session->check('recent.contest')) $this->redirect(array('action'=>'view', $this->Session->read('recent.contest')));

		//otherwise, redirect to first contest
		$this->loadModel('Contest');
		$this->Contest->recursive = 0;
		$contests = $this->Contest->find('all', array(
			'order' => array('Contest.date' => 'asc')
		));
		if( isset($contests[0]) ){
			$this->redirect( array('action'=>'view', $contests[0]['Contest']['id']) );
		} else {
			exit();
		}
	}

	public function view($contest_id = null) {
		$this->loadModel('Contest');
		if (!$this->Contest->exists($contest_id)) throw new NotFoundException();
		$this->Session->write('recent.contest', $contest_id);
		$this->set('contest', $this->Contest->find('first', array('conditions' => array('Contest.id'=>$contest_id)) ));
		$this->Point->recursive = 0;
		$this->set('points', $this->Point->find('threaded',array(
			'conditions' => array('Contest.id'=>$contest_id),
			'order'=>'lft'
		)));

		$this->set('contests', $this->Contest->find('all', array(
			'order' => array('Contest.date' => 'asc'),
		)));
	}

	public function add($contest_id = null) {
		$this->loadModel('Contest');
		if (!$this->Contest->exists($contest_id)) throw new NotFoundException();
		$this->set('contest_id', $contest_id);
		if ($this->request->is('post')) {
			$this->Point->create();
			if($this->request->data['Point']['parent_id']=='0') $this->request->data['Point']['parent_id']=null;
			if ($this->Point->save($this->request->data)) {
				$this->Session->setFlash('Het beoordelingspunt is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'view', $contest_id));
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
				$this->redirect(array('action'=>'view', $this->request->data['Point']['contest_id']));
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
		$this->Point->id = $id;
		$point = $this->Point->read();
		if ($this->Point->removeFromTree($id,true)) {
			$this->Session->setFlash('Het beoordelingspunt is verwijderd', 'flash_info');
		} else {
			$this->Session->setFlash('Het beoordelingspunt kon niet worden verwijderd', 'flash_error');
		}
		$this->redirect(array('action'=>'view', $point['Point']['contest_id']));
	}

	function moveup($id = null) {
		$this->request->onlyAllow('post');
		if (!$this->Point->exists($id)) throw new NotFoundException();
		if(!$this->Point->moveUp($id)) $this->Session->setFlash('Dit beoordelingspunt kan niet verder naar boven worden verplaatst', 'flash_error');
		$this->Point->id = $id;
		$point = $this->Point->read();
		$this->redirect(array('action'=>'view', $point['Point']['contest_id']));
	}

	function movedown($id = null) {
		$this->request->onlyAllow('post');
		if (!$this->Point->exists($id)) throw new NotFoundException();
		if(!$this->Point->moveDown($id)) $this->Session->setFlash('Dit beoordelingspunt kan niet verder naar onder worden verplaatst', 'flash_error');
		$this->Point->id = $id;
		$point = $this->Point->read();
		$this->redirect(array('action'=>'view', $point['Point']['contest_id']));
	}
}
