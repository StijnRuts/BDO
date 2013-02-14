<div class="row">
	<div class="ten columns centered">
		<?= $this->Form->create('Contest'); ?>
			<fieldset>
				<legend>Jurysamenstelling bewerken</legend>
				<?= $this->Form->input('id'); ?>
					<div class="row">
						<div class="twelve columns">
							<?= $this->Form->input('user', array(
								'label'=>false,
								'multiple'=>'checkbox',
								'selected' => $selected
							) ); ?>
						</div>
					</div>
			</fieldset>
			<div class="row">
				<div class="six columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
				<div class="six columns"><?= $this->Html->link('Anuleren', array('controller'=>'contests', 'action'=>'index'), array('class'=>'radius secondary button')); ?></div>
			</div>
		<?= $this->Form->end(); ?>
	</div>
</div>
