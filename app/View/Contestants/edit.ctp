<?php echo $this->Form->create('Contestant'); ?>
	<fieldset>
		<legend>Lid bewerken</legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('club_id');
			echo $this->Form->input('discipline_id');
			echo $this->Form->input('category_id');
			echo $this->Form->input('division_id');
			echo $this->Form->input('startnr');
			echo $this->Form->input('name');
		?>
	</fieldset>
<?php echo $this->Form->end('Opslaan'); ?>
