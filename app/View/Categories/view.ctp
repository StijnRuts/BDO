<div class="categories view">
<h2><?php  echo __('Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($category['Category']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo h($category['Category']['order']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($category['Category']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Category'), array('action' => 'edit', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Category'), array('action' => 'delete', $category['Category']['id']), null, __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contestants'), array('controller' => 'contestants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Contestants'); ?></h3>
	<?php if (!empty($category['Contestant'])): ?>
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
		foreach ($category['Contestant'] as $contestant): ?>
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
