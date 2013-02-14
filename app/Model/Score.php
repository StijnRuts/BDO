<?php
class Score extends AppModel {

	public $validate = array(
		'score' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Er is geen waarde opgegeven',
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Gelieve een getal op te geven',
			),
		),
	);

	public $belongsTo = array('Point', 'User', 'Contestant');
}
