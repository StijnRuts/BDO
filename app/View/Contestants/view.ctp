<div class="contestants view">
<h2><?php  echo __('Contestant'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($contestant['Contestant']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Club'); ?></dt>
		<dd>
			<?php echo $this->Html->link($contestant['Club']['name'], array('controller' => 'clubs', 'action' => 'view', $contestant['Club']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Discipline'); ?></dt>
		<dd>
			<?php echo $this->Html->link($contestant['Discipline']['name'], array('controller' => 'disciplines', 'action' => 'view', $contestant['Discipline']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($contestant['Category']['name'], array('controller' => 'categories', 'action' => 'view', $contestant['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Division'); ?></dt>
		<dd>
			<?php echo $this->Html->link($contestant['Division']['name'], array('controller' => 'divisions', 'action' => 'view', $contestant['Division']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Startnr'); ?></dt>
		<dd>
			<?php echo h($contestant['Contestant']['startnr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($contestant['Contestant']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contestant'), array('action' => 'edit', $contestant['Contestant']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Contestant'), array('action' => 'delete', $contestant['Contestant']['id']), null, __('Are you sure you want to delete # %s?', $contestant['Contestant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contestants'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contestant'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Disciplines'), array('controller' => 'disciplines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Discipline'), array('controller' => 'disciplines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Divisions'), array('controller' => 'divisions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Division'), array('controller' => 'divisions', 'action' => 'add')); ?> </li>
	</ul>
</div>
