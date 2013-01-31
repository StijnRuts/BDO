<?php echo $this->Form->create('Club'); ?>
	<fieldset>
		<legend>Club bewerken</legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name');
		?>
	</fieldset>
<?php echo $this->Form->end('Opslaan'); ?>
