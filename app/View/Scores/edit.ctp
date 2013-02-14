<div class="scores form">
<?php echo $this->Form->create('Score'); ?>
	<fieldset>
		<legend><?php echo __('Edit Score'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('point_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('contestant_id');
		echo $this->Form->input('score');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<?php echo $this->Html->link('terug', array('action'=>'index')); ?>