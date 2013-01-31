<?php echo $this->Form->create('Division'); ?>
	<fieldset>
		<legend>Divisie toevoegen</legend>
		<?php
			echo $this->Form->input('order');
			echo $this->Form->input('name');
		?>
	</fieldset>
<?php echo $this->Form->end('Opslaan'); ?>
