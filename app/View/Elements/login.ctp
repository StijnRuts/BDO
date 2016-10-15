<?php

$linkText = null;

if ($logged_in && $current_user['role'] == 'admin') {
  $linkText = 'Log uit '.$current_user['username'];
} elseif (isset($PCnumber)) {
  $linkText = 'PC '.$PCnumber;
  if ($logged_in) {
    $linkText .= ', '.$current_user['username'];
  }
}

if (!empty($linkText)) {
  echo $this->Html->Link($linkText,
    array('controller'=>'users', 'action'=>'logout'),
    array('class'=>'small button', 'id'=>'login')
  );
}
