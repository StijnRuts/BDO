<?php
class ContestusersController extends AppController {

	public function index() {
		//if recent contest is set => redirect
		if($this->Session->check('recent.contest')) $this->redirect(array('action'=>'edit', $this->Session->read('recent.contest')));

		//otherwise, redirect to first contest
		$this->loadModel('Contest');
		$this->Contest->recursive = 0;
		$contests = $this->Contest->find('all', array(
			'order' => array('Contest.date' => 'asc')
		));
		if( isset($contests[0]) ){
			$this->redirect( array('action'=>'contest', $contests[0]['Contest']['id']) );
		} else {
			exit();
		}
	}

	public function edit($contest_id = null) {
		$this->loadModel('Contest');
		if(!$this->Contest->exists($contest_id)) throw new NotFoundException();
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['User'] = $this->request->data['Contest']['user'];
			unset($this->request->data['Contest']['user']);
			if($this->request->data['User']=='') $this->request->data['User']=array('User'=>'');
			if ($this->Contest->save($this->request->data)) {
				$this->Session->setFlash('De jurysamenstelling is opgeslaan', 'flash_success');
				$this->Session->write('recent.contest', $contest_id);
				$this->redirect(array('controller'=>'contests', 'action'=>'index'));
			} else {
				$this->Session->setFlash('De jurysamenstelling kon niet worden opgeslaan', 'flash_error');
			}
		} else {
			$this->Contest->id = $contest_id;
			$this->request->data = $this->Contest->read();
		}
		$users = $this->Contest->User->find('list', array(
			'fields' => array('id','username'),
			'order' => array('username'=>'asc'),
			'conditions' => array('role'=>'jury')
		));
		$this->set(compact('users'));

		$this->Contest->id = $contest_id;
		$contest = $this->Contest->read();
		$this->set('contest', $contest);
		$selected = array();
		foreach($contest['User'] as $user) $selected[] = (int)$user['id'];
		$this->set('selected', $selected);
	}

}
