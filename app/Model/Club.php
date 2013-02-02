<?php
class Club extends AppModel {

	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule'=>array('notempty'),
				'message' => 'Er is geen naam opgegeven',
			),
			'maxlength' => array(
				'rule' => array('maxlength', 100),
				'message' => 'Deze naam is te lang',
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Er bestaat al een club met deze naam'
			),
		),
	);

	public $hasMany = array('Contestant');
}
?>