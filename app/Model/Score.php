<?php
class Score extends AppModel {

	public $validate = array(
		'score' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Gelieve een getal op te geven',
			),
		),
	);

	public $belongsTo = array('Point', 'User', 'Contestant', 'Round');
}
