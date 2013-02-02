<?php
class SortableHelper extends AppHelper
{
	public $helpers = array('Js');

	public function init(){
		$this->Js->get('#sortable tbody')->sortable(array(
			'distance' => 15,
			'handle' => '.sorthandle',
		   'complete' => '$.post("'.Router::url(array('action'=>'reorder')).'", $("#sortable tbody").sortable("serialize"))'
		));
	}
}
?>