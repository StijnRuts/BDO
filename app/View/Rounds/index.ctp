<div class="rounds index">
	<h2><?php echo __('Rounds'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('order'); ?></th>
			<th><?php echo $this->Paginator->sort('contest_id'); ?></th>
			<th><?php echo $this->Paginator->sort('discipline_id'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('division_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($rounds as $round): ?>
	<tr>
		<td><?php echo h($round['Round']['id']); ?>&nbsp;</td>
		<td><?php echo h($round['Round']['order']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($round['Contest']['name'], array('controller' => 'contests', 'action' => 'view', $round['Contest']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($round['Discipline']['name'], array('controller' => 'disciplines', 'action' => 'view', $round['Discipline']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($round['Category']['name'], array('controller' => 'categories', 'action' => 'view', $round['Category']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($round['Division']['name'], array('controller' => 'divisions', 'action' => 'view', $round['Division']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $round['Round']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $round['Round']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $round['Round']['id']), null, __('Are you sure you want to delete # %s?', $round['Round']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Round'), array('action' => 'add')); ?></li>
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
