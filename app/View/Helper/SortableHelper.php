<?php

class SortableHelper extends AppHelper
{
  public $helpers = array('Js');

  public function init($controller = null, $element = '#sortable', $handle = '.sorthandle')
  {
    $url = array('action'=>'reorder');
    if ($controller) {
      $url['controller'] = $controller;
    }
    $this->Js->get($element)->sortable(array(
      'distance' => 15,
      'handle' => $handle,
      'complete' => '$.post("'.Router::url($url).'", $("'.$element.'").sortable("serialize"))',
    ));
  }
}
