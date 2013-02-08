<?php
class SortableHelper extends AppHelper
{
	public $helpers = array('Js');

	public function init($controller = null){
		$url = array('action'=>'reorder');
		if($controller) $url['controller'] = $controller;
		$this->Js->get('#sortable tbody')->sortable(array(
			'distance' => 15,
			'handle' => '.sorthandle',
		   'complete' => '$.post("'.Router::url($url).'", $("#sortable tbody").sortable("serialize"))'
		));
	}
}
?>