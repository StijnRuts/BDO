<?php
class RoundsController extends AppController {

	public function index() {
		$this->loadModel('Contest');
		$this->Contest->recursive = 0;
		$this->set('contests', $this->Contest->find('all', array(
			'order' => array('Contest.date' => 'asc'),
		)));
	}

	public function view($contest_id = null) {
		$this->loadModel('Contest');
		if (!$this->Contest->exists($contest_id)) throw new NotFoundException();
		$this->set('contest', $this->Contest->find('first', array(
			'conditions' => array('Contest.id'=>$contest_id),
			'contain' => array('Round' => array('order'=>'Round.order', 'Category', 'Discipline', 'Division'))
		)));
	}

	public function add($contest_id = null) {
		$this->loadModel('Contest');
		if(!$this->Contest->exists($contest_id)) throw new NotFoundException();
		if ($this->request->is('post')) {
			$maxorder = $this->Round->find('first', array(
				'order'=>'Round.order DESC',
				'conditions' => array('Contest.id' => $this->request->data['Round']['contest_id'])
			));
			$this->request->data['Round']['order'] = $maxorder['Round']['order']+1;

			$this->Round->create();
			if ($this->Round->save($this->request->data)) {
				$this->Session->setFlash('De ronde is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'view', $this->request->data['Round']['contest_id']));
			} else {
				$this->Session->setFlash('De ronde kon niet worden opgeslaan', 'flash_error');
			}
		}
		$contests = $this->Round->Contest->find('list', array('order'=>array('Contest.date'=>'asc')) );
		$disciplines = $this->Round->Discipline->find('list', array('order'=>array('Discipline.order'=>'asc')) );
		$categories = $this->Round->Category->find('list', array('order'=>array('Category.order'=>'asc')) );
		$divisions = $this->Round->Division->find('list', array('order'=>array('Division.order'=>'asc')) );
		$this->set(compact('contests', 'disciplines', 'categories', 'divisions'));
		$this->set('contest_id', $contest_id);
	}

	public function edit($id = null) {
		if (!$this->Round->exists($id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Round->save($this->request->data)) {
				$this->Session->setFlash('De ronde is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'view', $this->request->data['Round']['contest_id']));
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
		$this->set(compact('contests', 'disciplines', 'categories', 'divisions'));
	}

	public function delete($id = null) {
		if (!$this->Round->exists($id)) throw new NotFoundException();
		$this->request->onlyAllow('post', 'delete');
		if ($this->Round->delete($id)) {
			$this->Session->setFlash('De ronde is verwijderd', 'flash_info');
		} else {
			$this->Session->setFlash('De ronde kon niet worden verwijderd', 'flash_error');
		}
		$this->Round->id = $id;
		$round = $this->Round->read();
		$this->redirect(array('action'=>'view', $round['Contest']['id']));
	}

	public function contestants($id = null) {
		if (!$this->Round->exists($id)) throw new NotFoundException();
		$this->Round->id = $id;
		$round = $this->Round->read();

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Round'] = array('id'=>$id);
			if(!isset($this->request->data['Contestant'])) $this->request->data['Contestant'] = array('Contestant'=>'');

			if ($this->Round->save($this->request->data)) {
				$this->Session->setFlash('De deelnemerlijst is opgeslaan', 'flash_success');
				$this->redirect(array('action'=>'view', $round['Round']['contest_id']));
			} else {
				$this->Session->setFlash('De deelnemerlijst kon niet worden opgeslaan', 'flash_error');
			}
		}

		$this->loadModel('Contestant');
		$this->Contestant->recursive = 0;
		$this->set('contestants', $this->Contestant->find('all'));
		$this->set('round', $round);

		$selected = array();
		foreach($round['Contestant'] as $contestant) $selected[] = $contestant['id'];
		$this->set('selected', $selected);
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
