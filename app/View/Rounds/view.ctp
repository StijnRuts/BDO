<div class="rounds view">
<h2><?php  echo __('Round'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($round['Round']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo h($round['Round']['order']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contest'); ?></dt>
		<dd>
			<?php echo $this->Html->link($round['Contest']['name'], array('controller' => 'contests', 'action' => 'view', $round['Contest']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Discipline'); ?></dt>
		<dd>
			<?php echo $this->Html->link($round['Discipline']['name'], array('controller' => 'disciplines', 'action' => 'view', $round['Discipline']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($round['Category']['name'], array('controller' => 'categories', 'action' => 'view', $round['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Division'); ?></dt>
		<dd>
			<?php echo $this->Html->link($round['Division']['name'], array('controller' => 'divisions', 'action' => 'view', $round['Division']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Round'), array('action' => 'edit', $round['Round']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Round'), array('action' => 'delete', $round['Round']['id']), null, __('Are you sure you want to delete # %s?', $round['Round']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rounds'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Round'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Contestants'); ?></h3>
	<?php if (!empty($round['Contestant'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Club Id'); ?></th>
		<th><?php echo __('Discipline Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Division Id'); ?></th>
		<th><?php echo __('Startnr'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($round['Contestant'] as $contestant): ?>
		<tr>
			<td><?php echo $contestant['id']; ?></td>
			<td><?php echo $contestant['club_id']; ?></td>
			<td><?php echo $contestant['discipline_id']; ?></td>
			<td><?php echo $contestant['category_id']; ?></td>
			<td><?php echo $contestant['division_id']; ?></td>
			<td><?php echo $contestant['startnr']; ?></td>
			<td><?php echo $contestant['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'contestants', 'action' => 'view', $contestant['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'contestants', 'action' => 'edit', $contestant['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'contestants', 'action' => 'delete', $contestant['id']), null, __('Are you sure you want to delete # %s?', $contestant['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
