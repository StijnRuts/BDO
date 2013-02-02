<?php
class Division extends AppModel {

	public $validate = array(
		'order' => array(
			'notempty' => array('rule'=>array('notempty')),
			'numeric' => array('rule'=>array('numeric')),
		),
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
	);

	public $hasMany = array('Contestant');
}
?>