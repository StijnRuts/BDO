<div class="contests view">
<h2><?php  echo __('Contest'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($contest['Contest']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($contest['Contest']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($contest['Contest']['date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contest'), array('action' => 'edit', $contest['Contest']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Contest'), array('action' => 'delete', $contest['Contest']['id']), null, __('Are you sure you want to delete # %s?', $contest['Contest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contest'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rounds'), array('controller' => 'rounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Round'), array('controller' => 'rounds', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Rounds'); ?></h3>
	<?php if (!empty($contest['Round'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Order'); ?></th>
		<th><?php echo __('Contest Id'); ?></th>
		<th><?php echo __('Discipline Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Division Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($contest['Round'] as $round): ?>
		<tr>
			<td><?php echo $round['id']; ?></td>
			<td><?php echo $round['order']; ?></td>
			<td><?php echo $round['contest_id']; ?></td>
			<td><?php echo $round['discipline_id']; ?></td>
			<td><?php echo $round['category_id']; ?></td>
			<td><?php echo $round['division_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'rounds', 'action' => 'view', $round['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'rounds', 'action' => 'edit', $round['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'rounds', 'action' => 'delete', $round['id']), null, __('Are you sure you want to delete # %s?', $round['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Round'), array('controller' => 'rounds', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
