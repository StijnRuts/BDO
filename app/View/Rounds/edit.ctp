<div class="rounds form">
<?php echo $this->Form->create('Round'); ?>
	<fieldset>
		<legend><?php echo __('Edit Round'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('order');
		echo $this->Form->input('contest_id');
		echo $this->Form->input('discipline_id');
		echo $this->Form->input('category_id');
		echo $this->Form->input('division_id');
		echo $this->Form->input('Contestant');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Round.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Round.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rounds'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Contests'), array('controller' => 'contests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contest'), array('controller' => 'contests', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Disciplines'), array('controller' => 'disciplines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Discipline'), array('controller' => 'disciplines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Divisions'), array('controller' => 'divisions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Division'), array('controller' => 'divisions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contestants'), array('controller' => 'contestants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
	</ul>
</div>
