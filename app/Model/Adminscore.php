<?php
class Adminscore extends AppModel {

	public $validate = array(
		'verplichtelem' => array(
			'naturalnumber' => array(
				'rule' => array('naturalnumber', true),
				'message' => 'Gelieve een getal op te geven',
				'allowEmpty' => true
			),
			'max' => array(
				'rule' => array('comparison', '<=', 15),
				'message' => 'De verplichte elementen kunnen maximum 15 zijn'
			)
		),
		'strafpunten' => array(
			'naturalnumber' => array(
				'rule' => array('naturalnumber', true),
				'message' => 'Gelieve een getal op te geven',
				'allowEmpty' => true
			),
		),
	);

	public $belongsTo = array('Contestant', 'Round');
}
