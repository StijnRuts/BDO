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
		'max' => array(
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

	public $belongsTo = array('Contest');
	public $hasMany = array('Score');
	public $actsAs = array('Tree');
}
