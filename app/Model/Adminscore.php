<?php
class Adminscore extends AppModel {

	public $validate = array(
		'verplichtelem' => array(
			'naturalnumber' => array(
				'rule' => array('naturalnumber'),
				'message' => 'Gelieve een getal op te geven',
				'allowEmpty' => true
			),
		),
		'strafpunten' => array(
			'naturalnumber' => array(
				'rule' => array('naturalnumber'),
				'message' => 'Gelieve een getal op te geven',
				'allowEmpty' => true
			),
		),
	);

	public $belongsTo = array('Contestant', 'Round');
}
