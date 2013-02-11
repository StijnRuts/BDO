<?php
class Contest extends AppModel {

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
		'date' => array(
			'date' => array(
				'rule' => array('date'),
			),
		),
	);

	public $hasMany = array('Round', 'Point');
}
