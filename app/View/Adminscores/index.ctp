<div class="adminscores index">
	<h2><?php echo __('Adminscores'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('contestant_id'); ?></th>
			<th><?php echo $this->Paginator->sort('round_id'); ?></th>
			<th><?php echo $this->Paginator->sort('verplichtelem'); ?></th>
			<th><?php echo $this->Paginator->sort('strafpunten'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($adminscores as $adminscore): ?>
	<tr>
		<td><?php echo h($adminscore['Adminscore']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($adminscore['Contestant']['name'], array('controller' => 'contestants', 'action' => 'view', $adminscore['Contestant']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($adminscore['Round']['id'], array('controller' => 'rounds', 'action' => 'view', $adminscore['Round']['id'])); ?>
		</td>
		<td><?php echo h($adminscore['Adminscore']['verplichtelem']); ?>&nbsp;</td>
		<td><?php echo h($adminscore['Adminscore']['strafpunten']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $adminscore['Adminscore']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $adminscore['Adminscore']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $adminscore['Adminscore']['id']), null, __('Are you sure you want to delete # %s?', $adminscore['Adminscore']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Adminscore'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Contestants'), array('controller' => 'contestants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rounds'), array('controller' => 'rounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Round'), array('controller' => 'rounds', 'action' => 'add')); ?> </li>
	</ul>
</div>
