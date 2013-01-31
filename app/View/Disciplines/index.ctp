<div class="disciplines index">
	<h2><?php echo __('Disciplines'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('order'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($disciplines as $discipline): ?>
	<tr>
		<td><?php echo h($discipline['Discipline']['id']); ?>&nbsp;</td>
		<td><?php echo h($discipline['Discipline']['order']); ?>&nbsp;</td>
		<td><?php echo h($discipline['Discipline']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $discipline['Discipline']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $discipline['Discipline']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $discipline['Discipline']['id']), null, __('Are you sure you want to delete # %s?', $discipline['Discipline']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Discipline'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Contestants'), array('controller' => 'contestants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
	</ul>
</div>
