<div class="row">
	<div class="ten columns centered">
		<?= $this->Form->create('Discipline'); ?>
			<fieldset>
				<legend>Discipline toevoegen</legend>
				<div class="row">
					<div class="twelve columns"><?= $this->Form->input('name', array('label'=>'Disciplinenaam') ); ?></div>
				</div>
			</fieldset>
			<div class="row">
				<div class="six columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
				<div class="six columns"><?= $this->Html->link('Anuleren', array('action'=>'index'), array('class'=>'radius secondary button')); ?></div>
			</div>
		<?= $this->Form->end(); ?>
	</div>
</div>