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


	public function beforeSave($options = array())
	{
		if (isset($this->data['Contestant']['startnr'])) {
			$startnr = strtoupper(trim( $this->data['Contestant']['startnr'] ));
			$nrzeros = strlen( $this->firstmatch('/^0*/', $startnr) );
			$number = (int)$this->firstmatch('/^[0-9]*/', $startnr);
			$letter = $this->firstmatch('/[A-Z]/', $startnr);
			$letter = $letter=='' ? 99 : ord($letter);
			$this->data['Contestant']['startnrorder'] = -1000000*$nrzeros + ($nrzeros>0 ? -1 : 1)*(100*$number + $letter);
		}
	}

	private function firstmatch($pattern, $subject)
	{
		$matches = array();
		preg_match($pattern, $subject, $matches);
		return count($matches)>0 ? $matches[0] : '';
	}

	public function getScores($round_id)
	{
		$scores = $this->get_scores($round_id);
		$users = $this->get_users($round_id);
		$points = $this->get_points($round_id);

		$this->add_verplichtelem($round_id, $scores, $users, $points);
		$scores = $this->calculate_jurytotals($scores, $users, $points, 'total');
		$scores = array(
			'scores' => $scores,
			'users' => $users,
			'points' => $points,
		);
		$scores = $this->calculate_categorytotals($scores);
		$scores = $this->calculate_adminscores($scores, $round_id);
		$scores = $this->calculate_minmax($scores);
		$scores = $this->calculate_total($scores);

		return $scores;
	}

	/**
	 * Sorts scores and users by total score
	 * @param $scores
	 */
	public function sortScores($scores)
	{
			uasort($scores['scores'], function ($a, $b) {
					return $b['total'] - $a['total'];
			});

			$ordering = array_keys($scores['scores']);
			usort($scores['users'], function ($a, $b) use ($ordering) {
					$a = array_search($a['id'], $ordering);
					$b = array_search($b['id'], $ordering);
					return $a - $b;
			});

			return $scores;
	}

	private function get_scores($round_id)
	{
		$contestant = $this->read();

		$scores = array();
		$Score = ClassRegistry::init('Score');
		$s = $Score->find('all', array(
			'conditions' => array(
				'contestant_id' => $contestant['Contestant']['id'],
				'round_id' => $round_id,
			)
		));
		foreach ($s as $score) {
			$scores[$score['Score']['user_id']][$score['Score']['point_id']] = $score['Score']['score'];
		}

		return $scores;
	}

	public function get_users($round_id)
	{
		$Round = ClassRegistry::init('Round');
		$Round->id = $round_id;
		$round = $Round->read();

		return $round['User'];
	}

	private function get_points($round_id)
	{
		$Round = ClassRegistry::init('Round');
		$Round->id = $round_id;
		$round = $Round->read();

		$Point = ClassRegistry::init('Point');
		$Point->recursive = 0;
		$points = $Point->find('threaded', array(
			'conditions' => array('Contest.id'=>$round['Contest']['id']),
			'fields' => array('id', 'parent_id', 'name', 'max'),
			'order' => 'lft',
		));

		return $points;
	}

	private function add_verplichtelem($round_id, &$scores, &$users, &$points)
	{
		$Adminscore = ClassRegistry::init('Adminscore');
		$contestant = $this->read();

		$s = $Adminscore->find('first', array(
			'conditions' => array(
				'contestant_id' => $contestant['Contestant']['id'],
				'round_id' => $round_id,
			)
		));

		$verplichtelem = isset($s['Adminscore']['verplichtelem']) ? $s['Adminscore']['verplichtelem'] : 0;

		if ($verplichtelem > 0) {
			$points[] = array(
				'Point' => array(
					'id' => -1,
					'parent_id' => null,
					'name' => 'Verplichte elementen',
					'max' => 15
				),
				'children' => array(),
			);
			foreach ($users as $user) {
				$scores[$user['id']][-1] = $verplichtelem;
			}
		}

		return $scores;
	}

	private function calculate_jurytotals($scores, $users, $points, $group)
	{
		foreach ($users as $user) {
			$scores[$user['id']][$group] = 0;
		}

		foreach ($points as $point) {
			if (count($point['children']) > 0) {
				$scores = $this->calculate_jurytotals($scores, $users, $point['children'], $point['Point']['id']);
			}
			foreach ($users as $user) {
				if (isset($scores[$user['id']][$point['Point']['id']])) {
					$scores[$user['id']][$group] += $scores[$user['id']][$point['Point']['id']];
				}
			}
		}

		return $scores;
	}

	private function calculate_categorytotals($scores)
	{
		$scores['maxtotal'] = $this->sum_of_max($scores['points']);
		return $scores;
	}

	private function sum_of_max(&$points)
	{
		$sum = 0;
		foreach ($points as &$point) {
			if (count($point['children']) > 0) {
				$point['Point']['max'] = $this->sum_of_max($point['children']);
			}
			$sum += $point['Point']['max'];
		}
		return $sum;
	}

	private function calculate_adminscores ($scores, $round_id)
	{
		$Adminscore = ClassRegistry::init('Adminscore');
		$contestant = $this->read();

		$s = $Adminscore->find('first', array(
			'conditions' => array(
				'contestant_id' => $contestant['Contestant']['id'],
				'round_id' => $round_id,
			)
		));

		$scores['strafpunten'] = isset($s['Adminscore']['strafpunten']) ? $s['Adminscore']['strafpunten'] : 0;
		$scores['verplichtelem'] = isset($s['Adminscore']['verplichtelem']) ? $s['Adminscore']['verplichtelem'] : 0;

		return $scores;
	}

	private function calculate_minmax($scores)
	{
		$min = $scores['scores'][$scores['users'][0]['id']]['total'];
		$min_id = $scores['users'][0]['id'];

		foreach ($scores['users'] as $user) {
			if ($scores['scores'][$user['id']]['total'] <= $min) {
				$min = $scores['scores'][$user['id']]['total'];
				$min_id = $user['id'];
			}
		}

		$max = $scores['scores'][$scores['users'][0]['id']]['total'];
		$max_id = $scores['users'][0]['id'];

		foreach ($scores['users'] as $user) {
			if ($scores['scores'][$user['id']]['total'] >= $max && $user['id'] != $min_id) {
				$max = $scores['scores'][$user['id']]['total'];
				$max_id = $user['id'];
			}
		}

		$scores['min'] = $min_id;
		$scores['max'] = $max_id;

		return $scores;
	}

	private function calculate_total($scores)
	{
		$total = 0;
		$min_id = $scores['min'];
		$max_id = $scores['max'];

		foreach ($scores['users'] as $user) {
			if (($user['id'] != $min_id) && ($user['id'] != $max_id)) {
				$total += $scores['scores'][$user['id']]['total'];
			}
		}

		$total -= $scores['strafpunten'];
		$scores['total'] = $total;

		return $scores;
	}
}
