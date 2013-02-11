<div class="defaultpoints index">
	<h2><?php echo __('Defaultpoints'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lft'); ?></th>
			<th><?php echo $this->Paginator->sort('rght'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('min'); ?></th>
			<th><?php echo $this->Paginator->sort('max'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($defaultpoints as $defaultpoint): ?>
	<tr>
		<td><?php echo h($defaultpoint['Defaultpoint']['id']); ?>&nbsp;</td>
		<td><?php echo h($defaultpoint['Defaultpoint']['parent_id']); ?>&nbsp;</td>
		<td><?php echo h($defaultpoint['Defaultpoint']['lft']); ?>&nbsp;</td>
		<td><?php echo h($defaultpoint['Defaultpoint']['rght']); ?>&nbsp;</td>
		<td><?php echo h($defaultpoint['Defaultpoint']['name']); ?>&nbsp;</td>
		<td><?php echo h($defaultpoint['Defaultpoint']['min']); ?>&nbsp;</td>
		<td><?php echo h($defaultpoint['Defaultpoint']['max']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $defaultpoint['Defaultpoint']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $defaultpoint['Defaultpoint']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $defaultpoint['Defaultpoint']['id']), null, __('Are you sure you want to delete # %s?', $defaultpoint['Defaultpoint']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Defaultpoint'), array('action' => 'add')); ?></li>
	</ul>
</div>
