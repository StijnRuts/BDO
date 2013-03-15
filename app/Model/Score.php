<?php
class Score extends AppModel {

	public $validate = array(
		'score' => array(
			'naturalNumber' => array(
				'rule' =>  array('naturalNumber', true),
				'message' => 'Gelieve een getal op te geven',
			),
			'max' => array(
				'rule' => array('comparison', '<=', 10),
				'message' => 'Dit getal kan maximaal 10 zijn'
			)
		),
	);

	public $belongsTo = array('Point', 'User', 'Contestant', 'Round');

	public function beforeValidate($options = array()){
		$Score = ClassRegistry::init('Score');
		$Score->id = $this->data['Score']['id'];
		$score = $Score->read();
		$max = $score['Point']['max'];
		$this->validator()->getField('score')->setRule('max', array(
			'rule' => array('comparison', '<=', $max),
			'message' => 'Dit getal kan maximaal '.$max.' zijn'
		));

		//return true;
	}
}
