<div class="adminscores form">
<?php echo $this->Form->create('Adminscore'); ?>
	<fieldset>
		<legend><?php echo __('Add Adminscore'); ?></legend>
	<?php
		echo $this->Form->input('contestant_id');
		echo $this->Form->input('round_id');
		echo $this->Form->input('verplichtelem');
		echo $this->Form->input('strafpunten');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Adminscores'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Contestants'), array('controller' => 'contestants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rounds'), array('controller' => 'rounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Round'), array('controller' => 'rounds', 'action' => 'add')); ?> </li>
	</ul>
</div>
