<?php
class Point extends AppModel {

	public $validate = array(
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
		'min' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Er is geen waarde opgegeven',
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Gelieve een getal op te geven',
			),
			'nottoobig' => array(
				'rule' => array('notTooBig'),
				'message' => 'De minimumscore moet kleiner zijn dan de maximumscore',
			),
		),
		'max' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Er is geen waarde opgegeven',
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Gelieve een getal op te geven',
			),
			'nottoosmall' => array(
				'rule' => array('notTooSmall'),
				'message' => 'De maximumscore moet groter zijn dan de minimumscore',
			),
		),
	);

	public function notTooBig($data) {
		return ($data['min'] < $this->data['Point']['max']);
	}
	public function notTooSmall($data) {
		return ($data['max'] > $this->data['Point']['min']);
	}

	public $belongsTo = array('Contest');
	public $hasMany = array('Score');
	public $actsAs = array('Tree');
}
