<?php
class Adminscore extends AppModel {

	public $validate = array(
		'verplichtelem' => array(
			'naturalnumber' => array(
				'rule' => 'decimal',
				'message' => 'Gelieve een getal op te geven',
				'allowEmpty' => true
			),
			'min' => array(
				'rule' => array('comparison', '>=', 0),
				'message' => 'Negatieve getallen zijn niet toegestaan'
			),
			'max' => array(
				'rule' => array('comparison', '<=', 15),
				'message' => 'De verplichte elementen kunnen maximum 15 zijn'
			)
		),
		'strafpunten' => array(
			'naturalnumber' => array(
				'rule' => 'decimal',
				'message' => 'Gelieve een getal op te geven',
				'allowEmpty' => true
			),
			'min' => array(
				'rule' => array('comparison', '>=', 0),
				'message' => 'Negatieve getallen zijn niet toegestaan'
			)
		),
	);

	public $belongsTo = array('Contestant', 'Round');
}
