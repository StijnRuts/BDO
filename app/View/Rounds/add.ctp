<div class="row">
	<div class="ten columns centered">
		<?= $this->Form->create('Round'); ?>
			<fieldset>
				<legend>Ronde toevoegen</legend>
					<?= $this->Form->input('contest_id', array('type'=>'hidden', 'value'=>$contest_id)); ?>
					<?= $this->Form->input('discipline_id'); ?>
					<?= $this->Form->input('category_id'); ?>
					<?= $this->Form->input('division_id'); ?>
			</fieldset>
			<div class="row">
				<div class="six columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
				<div class="six columns"><?= $this->Html->link('Anuleren', array('action'=>'index'), array('class'=>'radius secondary button')); ?></div>
			</div>
		<?= $this->Form->end(); ?>
	</div>
</div>
