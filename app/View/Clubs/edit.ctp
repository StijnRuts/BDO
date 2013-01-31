<div class="clubs form">
<?php echo $this->Form->create('Club'); ?>
	<fieldset>
		<legend>Edit Club</legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name');
		?>
	</fieldset>
<?php echo $this->Form->end('Opslaan'); ?>
</div>

<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Html->link('<- Terug', array('action'=>'index')); ?></li>
	</ul>
</div>
