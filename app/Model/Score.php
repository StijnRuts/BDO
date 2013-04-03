<?php
class Score extends AppModel {

	public $validate = array(
		'score' => array(
			'naturalNumber' => array(
				'rule' =>  array('naturalNumber', true),
				'message' => 'Gelieve een getal op te geven',
			)
		),

	);

	public $belongsTo = array('Point', 'User', 'Contestant', 'Round');

	public function beforeValidate($options = array()){
		$Score = ClassRegistry::init('Score');
		if( !isset($this->data['Score']['score']) || $this->data['Score']['score']==null ){;
			//$this->validator()->remove('score', 'naturalNumber');
		} else {
			$max = $Score->find('first', array(
				'conditions' => array('Score.id'=>$this->data['Score']['id']),
				'fields' => array('Point.max')
			));
			$max = $max['Point']['max'];
			$this->validator()->add('score', 'max', array(
				'rule' => array('comparison', '<=', $max),
				'message' => 'Dit getal kan maximaal '.$max.' zijn'
			));
		}
		return true;
	}

	public function setEmptyScores($list, $round_id, $contestant_id, $user_id){
		foreach($list as $point){
			if($point['Point']['id'] == -1) continue;
			$data = array(
				'contestant_id' => $contestant_id,
				'round_id' => $round_id,
				'point_id' => $point['Point']['id'],
				'user_id' => $user_id
			);
			if( !$this->hasAny($data) ) {
				$this->create();
				$this->save($data);
			}
			if( count($point['children'])>0 ) $this->setEmptyScores($point['children'], $round_id, $contestant_id, $user_id);
		}
	}
}
