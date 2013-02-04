<?php
class RoundsController extends AppController {

	public function view($id = null) {
		if (!$this->Round->exists($id)) throw new NotFoundException();
		$this->Round->id = $id;
		$this->set('round', $this->Round->read());
	}

	public function add($contest_id = null) {
		if(false) throw new NotFoundException();
		if ($this->request->is('post')) {
			$this->Round->create();
			$this->request->data['Round']['order'] = 1 + $this->Round->find('count', array(
				'conditions' => array('Contest.id' => $this->request->data['Round']['contest_id'])
			));
			if ($this->Round->save($this->request->data)) {
				$this->Session->setFlash('De ronde is opgeslaan', 'flash_success');
				$this->redirect(array('controller'=>'contests', 'action'=>'rounds', $this->request->data['Round']['contest_id']));
			} else {
				$this->Session->setFlash('De ronde kon niet worden opgeslaan', 'flash_error');
			}
		}
		$contests = $this->Round->Contest->find('list', array('order'=>array('Contest.date'=>'asc')) );
		$disciplines = $this->Round->Discipline->find('list', array('order'=>array('Discipline.order'=>'asc')) );
		$categories = $this->Round->Category->find('list', array('order'=>array('Category.order'=>'asc')) );
		$divisions = $this->Round->Division->find('list', array('order'=>array('Division.order'=>'asc')) );
		$contestants = $this->Round->Contestant->find('list');
		$this->set(compact('contests', 'disciplines', 'categories', 'divisions', 'contestants'));
		$this->set('contest_id', $contest_id);
	}

	public function edit($id = null) {
		if (!$this->Round->exists($id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Round->save($this->request->data)) {
				$this->Session->setFlash('De ronde is opgeslaan', 'flash_success');
				$this->redirect(array('controller'=>'contests', 'action'=>'rounds', $this->request->data['Round']['contest_id']));
			} else {
				$this->Session->setFlash('De ronde kon niet worden opgeslaan', 'flash_error');
			}
		} else {
			$this->Round->id = $id;
			$this->request->data = $this->Round->read();
		}
		$contests = $this->Round->Contest->find('list', array('order'=>array('Contest.date'=>'asc')) );
		$disciplines = $this->Round->Discipline->find('list', array('order'=>array('Discipline.order'=>'asc')) );
		$categories = $this->Round->Category->find('list', array('order'=>array('Category.order'=>'asc')) );
		$divisions = $this->Round->Division->find('list', array('order'=>array('Division.order'=>'asc')) );
		$contestants = $this->Round->Contestant->find('list');
		$this->set(compact('contests', 'disciplines', 'categories', 'divisions', 'contestants'));
	}

	public function delete($id = null) {
		if (!$this->Round->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');

		$this->Round->id = $id;
		$round = $this->Round->read();

		if ($this->Round->delete($id)) {
			$this->Session->setFlash('De ronde is verwijderd', 'flash_info');
		} else {
			$this->Session->setFlash('De ronde kon niet worden verwijderd', 'flash_error');
		}
		$this->redirect(array('controller'=>'contests', 'action'=>'rounds', $round['Contest']['id']));
	}

	public function reorder(){
		$this->request->onlyAllow('post');
		foreach ($this->data['Round'] as $key => $value) {
			$this->Round->id = $value;
			$this->Round->saveField("order", $key+1);
		}
		exit();
	}
}
