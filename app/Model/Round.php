<?php
App::uses('AppModel', 'Model');
/**
 * Round Model
 *
 * @property Contest $Contest
 * @property Discipline $Discipline
 * @property Category $Category
 * @property Division $Division
 * @property Contestant $Contestant
 */
class Round extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'development';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'discipline_id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'order' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Contest' => array(
			'className' => 'Contest',
			'foreignKey' => 'contest_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Discipline' => array(
			'className' => 'Discipline',
			'foreignKey' => 'discipline_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Division' => array(
			'className' => 'Division',
			'foreignKey' => 'division_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Contestant' => array(
			'className' => 'Contestant',
			'joinTable' => 'rounds_contestants',
			'foreignKey' => 'round_id',
			'associationForeignKey' => 'contestant_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
