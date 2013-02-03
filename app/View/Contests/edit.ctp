<div class="contests form">
<?php echo $this->Form->create('Contest'); ?>
	<fieldset>
		<legend><?php echo __('Edit Contest'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Contest.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Contest.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Contests'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Rounds'), array('controller' => 'rounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Round'), array('controller' => 'rounds', 'action' => 'add')); ?> </li>
	</ul>
</div>
