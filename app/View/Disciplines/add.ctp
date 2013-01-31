<?php echo $this->Form->create('Discipline'); ?>
	<fieldset>
		<legend>Discipline toevoegen</legend>
		<?php
			echo $this->Form->input('order');
			echo $this->Form->input('name');
		?>
	</fieldset>
<?php echo $this->Form->end('Opslaan'); ?>
