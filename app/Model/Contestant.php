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
		$scores = $this->get_scores($round_id);
		$users = $this->get_users($round_id);
		$points = $this->get_points($round_id);

		$scores = $this->calculate_totals($scores, $users, $points, 'total');
		$scores = array(
			'scores' => $scores,
			'users' => $users,
			'points' => $points,
		);
		$scores = $this->calculate_minmax($scores);

		return $scores;
	}

	private function get_scores($round_id){
		$contestant = $this->read();

		$scores = array();
		$Score = ClassRegistry::init('Score');
		$s = $Score->find('all', array(
			'conditions' => array('contestant_id'=>$contestant['Contestant']['id'], 'round_id'=>$round_id) ));
		foreach($s as $score) $scores[$score['Score']['user_id']][$score['Score']['point_id']] = $score['Score']['score'];

		return $scores;
	}
	private function get_users($round_id){
		$Round = ClassRegistry::init('Round');
		$Round->id = $round_id;
		$round = $Round->read();

		$Contest = ClassRegistry::init('Contest');
		$contest = $Contest->find('first', array(
			'conditions' => array('id'=>$round['Contest']['id']),
			'contain'=>array(
				'User'=>array(
					'conditions' => array('User.role'=>'jury'),
					'order' => array('User.username'=>'asc'),
					'fields' => array('User.id', 'User.username')
				)
			)
		));
		return $contest['User'];
	}
	private function get_points($round_id){
		$Round = ClassRegistry::init('Round');
		$Round->id = $round_id;
		$round = $Round->read();

		$Point = ClassRegistry::init('Point');
		$Point->recursive = 0;
		$points = $Point->find('threaded', array(
			'conditions' => array('Contest.id'=>$round['Contest']['id']),
			'order'=>'lft',
			'fields'=>array('id', 'parent_id', 'name', 'min', 'max')
		));

		return $points;
	}

	private function calculate_totals($scores, $users, $points, $group){
		foreach($users as $user) $scores[$user['id']][$group] = 0;

		foreach($points as $point){
			if(count($point['children'])>0) $scores = $this->calculate_totals($scores, $users, $point['children'], $point['Point']['id']);
			foreach($users as $user){
				if( isset($scores[$user['id']][$point['Point']['id']]) ){
					$scores[$user['id']][$group] += $scores[$user['id']][$point['Point']['id']];
				}
			}
		}

		return $scores;
	}

	private function calculate_minmax($scores){
		$min = $scores['scores'][$scores['users'][0]['id']]['total'];
		$min_id = $scores['users'][0]['id'];

		foreach($scores['users'] as $user){
			if($scores['scores'][$user['id']]['total'] <= $min){
				$min = $scores['scores'][$user['id']]['total'];
				$min_id = $user['id'];
			}
		}

		$max = $scores['scores'][$scores['users'][0]['id']]['total'];
		$max_id = $scores['users'][0]['id'];

		foreach($scores['users'] as $user){
			if($scores['scores'][$user['id']]['total'] >= $max && $user['id']!=$min_id){
				$max = $scores['scores'][$user['id']]['total'];
				$max_id = $user['id'];
			}
		}

		$scores['min'] = $min_id;
		$scores['max'] = $max_id;


		$total = 0;
		foreach($scores['users'] as $user){
			if( ($user['id']!=$min_id) && ($user['id']!=$max_id) ){
				$total += $scores['scores'][$user['id']]['total'];
			}
		}
		$scores['total'] = $total;

		return $scores;
	}
}
?>