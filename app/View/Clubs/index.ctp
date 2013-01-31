<div class="clubs index">
	<h2><?php echo __('Clubs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo 'id'; ?></th>
			<th><?php echo 'name'; ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($clubs as $club): ?>
	<tr>
		<td><?php echo h($club['Club']['id']); ?>&nbsp;</td>
		<td><?php echo h($club['Club']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $club['Club']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $club['Club']['id']), null, __('Are you sure you want to delete # %s?', $club['Club']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Club'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Contestants'), array('controller' => 'contestants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
	</ul>
</div>
