<div class="divisions index">
	<h2><?php echo __('Divisions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo 'id'; ?></th>
			<th><?php echo 'order'; ?></th>
			<th><?php echo 'name'; ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($divisions as $division): ?>
	<tr>
		<td><?php echo h($division['Division']['id']); ?>&nbsp;</td>
		<td><?php echo h($division['Division']['order']); ?>&nbsp;</td>
		<td><?php echo h($division['Division']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $division['Division']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $division['Division']['id']), null, __('Are you sure you want to delete # %s?', $division['Division']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Division'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Contestants'), array('controller' => 'contestants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
	</ul>
</div>
