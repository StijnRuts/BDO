<?php
class User extends AppModel {

	public $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Er is geen naam opgegeven',
			),
			'maxlength' => array(
				'rule' => array('maxlength', 100),
				'message' => 'Deze naam is te lang',
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Er is geen paswoord opgegeven',
			),
		),
		'role' => array(
			'notempty' => array(
				'rule' => array('inList', array('admin', 'jury')),
            'message' => 'Dit is geen geldige gebruikersrol',
            'allowEmpty' => false
			),
		),
	);
}
