<?php echo $this->Form->create('Division'); ?>
	<fieldset>
		<legend>Divisie bewerken</legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('order');
			echo $this->Form->input('name');
		?>
	</fieldset>
<?php echo $this->Form->end('Opslaan'); ?>
