<div class="row">
	<div class="ten columns centered">
		<?= $this->Form->create('Point'); ?>
			<fieldset>
				<legend>Beoordelingspunt toevoegen</legend>
				<?= $this->Form->input('contest_id', array('type'=>'hidden', 'value'=>$contest_id)); ?>
				<div class="row">
					<div class="twelve columns"><?= $this->Form->input('name', array('label'=>'Naam') ); ?></div>
					<div class="twelve columns"><?= $this->Form->input('max', array('label'=>'Maximumscore', 'value'=>10) ); ?></div>
					<div class="twelve columns"><?= $this->Form->input('parent_id', array('label'=>'Onderdeel van') ); ?></div>
				</div>
			</fieldset>
			<div class="row">
				<div class="six columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
				<div class="six columns"><?= $this->Html->link('Anuleren', array('action'=>'view', $contest_id), array('class'=>'radius secondary button')); ?></div>
			</div>
		<?= $this->Form->end(); ?>
	</div>
</div>