<?php
class Adminscore extends AppModel {

	public $validate = array(
		'verplichtelem' => array(
			'naturalnumber' => array(
				'rule' => array('naturalnumber'),
				'message' => 'Gelieve een getal op te geven',
			),
		),
		'strafpunten' => array(
			'naturalnumber' => array(
				'rule' => array('naturalnumber'),
				'message' => 'Gelieve een getal op te geven',
			),
		),
	);

	public $belongsTo = array('Contestant', 'Round');
}
