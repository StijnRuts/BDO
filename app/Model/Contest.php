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

	public function afterFind($results, $primary = false)
	{
		foreach ($results as $key => $val) {
			if (isset($val['Contest']['date'])) {
				$results[$key]['Contest']['USdate'] = $results[$key]['Contest']['date'];
				$results[$key]['Contest']['date'] = date('d-m-Y', strtotime($val['Contest']['date']));
			}
		}
		return $results;
	}

	// initializes the points for this contest with the values from defaultpoints
	public function initPoints()
	{
		$Defaultpoint = ClassRegistry::init('Defaultpoint');
		$Defaultpoint->recursive = 0;
		$defaultpoints = $Defaultpoint->find('threaded',array('order'=>'lft'));
		$this->addPoints($defaultpoints, null);
	}

	private function addPoints($points, $parent)
	{
		$Point = ClassRegistry::init('Point');
		foreach ($points as $point) {
			$Point->create();
			$Point->save(array(
				'name' => $point['Defaultpoint']['name'],
				'max' => $point['Defaultpoint']['max'],
				'parent_id' => $parent,
				'contest_id' => $this->id,
			));
			if (count($point['children']) > 0) {
				$this->addPoints($point['children'], $this->Point->getLastInsertID());
			}
		}
	}
}
