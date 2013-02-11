<div class="defaultpoints form">
<?php echo $this->Form->create('Defaultpoint'); ?>
	<fieldset>
		<legend><?php echo __('Add Defaultpoint'); ?></legend>
	<?php
		echo $this->Form->input('parent_id');
		echo $this->Form->input('lft');
		echo $this->Form->input('rght');
		echo $this->Form->input('name');
		echo $this->Form->input('min');
		echo $this->Form->input('max');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Defaultpoints'), array('action' => 'index')); ?></li>
	</ul>
</div>
