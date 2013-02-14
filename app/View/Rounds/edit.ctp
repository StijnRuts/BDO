<div class="row">
	<div class="ten columns centered">
		<?= $this->Form->create('Round'); ?>
			<fieldset>
				<legend>Ronde bewerken</legend>
				<?= $this->Form->input('id'); ?>
				<?= $this->Form->input('contest_id', array('type'=>'hidden')); ?>
					<?= $this->Form->input('discipline_id'); ?>
					<?= $this->Form->input('category_id'); ?>
					<?= $this->Form->input('division_id'); ?>
			</fieldset>
			<div class="row">
				<div class="six columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
				<div class="six columns"><?= $this->Html->link('Anuleren', array('action'=>'view', $this->request->data['Contest']['id']), array('class'=>'radius secondary button')); ?></div>
			</div>
		<?= $this->Form->end(); ?>
	</div>
</div>
