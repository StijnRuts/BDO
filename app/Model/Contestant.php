<?php
class Contestant extends AppModel {

	public $validate = array(
		'startnr' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => 'Dit is geen geldige startnummer',
				'allowEmpty' => true
			),
			'maxlength' => array(
				'rule' => array('maxlength', 10),
				'message' => 'Dit startnummer is te lang',
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Er is geen naam opgegeven',
			),
			'maxlength' => array(
				'rule' => array('maxlength', 100),
				'message' => 'Deze naam is te lang',
			),
		),
	);

	public $belongsTo = array(
		'Club',
		'Discipline',
		'Category',
		'Division'
	);
	public $hasAndBelongsToMany = array('Round');

	public function getScores($round_id) {
		$Round = ClassRegistry::init('Round');
		$Round->id = $round_id;
		$round = $Round->read();

		$Contest = ClassRegistry::init('Contest');
		$Contest->id = $round['Contest']['id'];

		$users = array();
		$u = $Contest->User->find('all', array(
			'conditions' => array('role'=>'jury'),
			'order' => array('User.username'=>'asc'),
			'fields' => array('id', 'username')
		));
		foreach($u as $user) $users[] = $user['User'];

		$Point = ClassRegistry::init('Point');
		$Point->recursive = 0;
		$points = $Point->find('threaded', array(
			'conditions' => array('Contest.id'=>$round['Contest']['id']),
			'order'=>'lft',
			'fields'=>array('id', 'parent_id', 'name', 'min', 'max')
		));

		$contestant = $this->read();
		$contestantsround = null;
		foreach($contestant['Round'] as $round) if($round['id']==$round_id) $contestantsround = $round['ContestantsRound']['id'];

		$scores = array();
		$Score = ClassRegistry::init('Score');
		$s = $Score->find('all', array( 'conditions' => array('contestants_round_id'=>$contestantsround) ));
		foreach($s as $score) $scores[$score['Score']['user_id']][$score['Score']['point_id']] = $score['Score']['score'];

		return array(
			'scores' => $scores,
			'users' => $users,
			'points' => $points,
		);
	}
}
?>