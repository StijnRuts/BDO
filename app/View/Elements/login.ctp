<?php if ($logged_in): ?>
  <?php echo $this->Html->Link('Log uit '.$current_user['username'],
    array('controller'=>'users', 'action'=>'logout'),
    array('class'=>'small button', 'id'=>'login')
  ); ?>
<?php endif; ?>
