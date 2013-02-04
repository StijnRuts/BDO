<div class="row">
	<div class="ten columns centered">
		<?php echo $this->Form->create('Round'); ?>
			<fieldset>
				<legend>Ronde bewerken</legend>
				<?= $this->Form->input('id'); ?>
					<?= $this->Form->input('contest_id'); ?>
					<?= $this->Form->input('discipline_id'); ?>
					<?= $this->Form->input('category_id'); ?>
					<?= $this->Form->input('division_id'); ?>
					<?= $this->Form->input('Contestant'); ?>
			</fieldset>
			<div class="row">
				<div class="six columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
				<div class="six columns"><?= $this->Html->link('Anuleren', array('action'=>'index'), array('class'=>'radius secondary button')); ?></div>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
