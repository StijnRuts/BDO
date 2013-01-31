<?php echo $this->Form->create('Club'); ?>
	<fieldset>
		<legend>Club toevoegen</legend>
		<?php
			echo $this->Form->input('name');
		?>
	</fieldset>
<?php echo $this->Form->end('Opslaan'); ?>
