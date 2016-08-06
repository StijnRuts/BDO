<?php
class Round extends AppModel {

	public $validate = array(
		'order' => array(
			'notempty' => array('rule' => array('notempty')),
			'numeric' => array('rule' => array('numeric')),
		),
	);

	public $belongsTo = array(
		'Contest',
		'Discipline',
		'Category',
		'Division'
	);

	public $hasAndBelongsToMany = array('Contestant', 'User');

	// initializes the users for this contest with the values for users with role 'jury'
	public function initUsers()
	{
		$User = ClassRegistry::init('User');
		$User->recursive = 0;

		$users = $User->find('list', array(
			'conditions' => array('User.role' => 'jury'),
			'fields' => array('User.id'),
			'order' => 'User.username',
		));
		$users = array_values($users);

		array_walk($users, function(&$user, $key) {
			$user = array(
				'id' => $user,
				'RoundsUser' => array(
					'user_id' => $user,
					'order' => $key,
				)
			);
		});

		$this->save(array('User' => $users));
	}
}
