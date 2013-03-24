<div class="adminscores view">
<h2><?php  echo __('Adminscore'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($adminscore['Adminscore']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contestant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($adminscore['Contestant']['name'], array('controller' => 'contestants', 'action' => 'view', $adminscore['Contestant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Round'); ?></dt>
		<dd>
			<?php echo $this->Html->link($adminscore['Round']['id'], array('controller' => 'rounds', 'action' => 'view', $adminscore['Round']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Verplichtelem'); ?></dt>
		<dd>
			<?php echo h($adminscore['Adminscore']['verplichtelem']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Strafpunten'); ?></dt>
		<dd>
			<?php echo h($adminscore['Adminscore']['strafpunten']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Adminscore'), array('action' => 'edit', $adminscore['Adminscore']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Adminscore'), array('action' => 'delete', $adminscore['Adminscore']['id']), null, __('Are you sure you want to delete # %s?', $adminscore['Adminscore']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Adminscores'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Adminscore'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contestants'), array('controller' => 'contestants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rounds'), array('controller' => 'rounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Round'), array('controller' => 'rounds', 'action' => 'add')); ?> </li>
	</ul>
</div>
