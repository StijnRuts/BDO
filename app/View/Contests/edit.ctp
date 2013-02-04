<div class="row">
	<div class="ten columns centered">
		<?php echo $this->Form->create('Contest'); ?>
			<fieldset>
				<legend>Wedstrijd bewerken</legend>
				<?= $this->Form->input('id'); ?>
					<div class="row">
						<div class="twelve columns"><?= $this->Form->input('date', array('label'=>'Datum') ); ?></div>
					</div>
					<div class="row">
						<div class="twelve columns"><?= $this->Form->input('name', array('label'=>'Wedstrijdnaam') ); ?></div>
					</div>
			</fieldset>
			<div class="row">
				<div class="six columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
				<div class="six columns"><?= $this->Html->link('Anuleren', array('action'=>'index'), array('class'=>'radius secondary button')); ?></div>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
