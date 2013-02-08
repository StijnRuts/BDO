<?php
class Round extends AppModel {

	public $validate = array(
		'order' => array(
			'notempty' => array('rule' => array('notempty')),
			'numeric' => array('rule' => array('numeric')),
		),
	);

	public $belongsTo = array(
		'Contest',
		'Discipline',
		'Category',
		'Division'
	);
	public $hasAndBelongsToMany = array('Contestant');
}
