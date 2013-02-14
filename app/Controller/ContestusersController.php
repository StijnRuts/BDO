<?php
class ContestusersController extends AppController {

	public function index() {
		$this->loadModel('Contest');
		$this->Contest->recursive = 0;
		$this->set('contests', $this->Contest->find('all', array(
			'order' => array('Contest.date' => 'asc'),
		)));
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
		$selected = array();
		foreach($contest['User'] as $user) $selected[] = (int)$user['id'];
		$this->set('selected', $selected);
	}

}
