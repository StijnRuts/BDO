<?php echo $this->Form->create('Category'); ?>
	<fieldset>
		<legend>Categorie toevoegen</legend>
		<?php
			echo $this->Form->input('order');
			echo $this->Form->input('name');
		?>
	</fieldset>
<?php echo $this->Form->end('Opslaan'); ?>
