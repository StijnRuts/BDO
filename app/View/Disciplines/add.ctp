<div class="disciplines form">
<?php echo $this->Form->create('Discipline'); ?>
	<fieldset>
		<legend>Discipline toevoegen</legend>
		<?php
			echo $this->Form->input('order');
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

