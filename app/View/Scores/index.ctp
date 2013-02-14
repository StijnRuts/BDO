<div class="scores index">
	<h2><?php echo __('Scores'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('point_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('contestant_id'); ?></th>
			<th><?php echo $this->Paginator->sort('score'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($scores as $score): ?>
	<tr>
		<td><?php echo h($score['Score']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($score['Point']['name'], array('controller' => 'points', 'action' => 'view', $score['Point']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($score['User']['id'], array('controller' => 'users', 'action' => 'view', $score['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($score['Contestant']['name'], array('controller' => 'contestants', 'action' => 'view', $score['Contestant']['id'])); ?>
		</td>
		<td><?php echo h($score['Score']['score']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $score['Score']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $score['Score']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $score['Score']['id']), null, __('Are you sure you want to delete # %s?', $score['Score']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Score'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Points'), array('controller' => 'points', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Point'), array('controller' => 'points', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contestants'), array('controller' => 'contestants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
	</ul>
</div>
