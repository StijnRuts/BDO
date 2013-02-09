<div class="row">
	<div class="ten columns centered">
		<?= $this->Form->create('User'); ?>
			<fieldset>
				<legend>Gebruiker bewerken</legend>
				<?= $this->Form->input('id'); ?>
				<div class="row">
					<div class="twelve columns"><?= $this->Form->input('username', array('label'=>'Gebruikersnaam')); ?></div>
					<div class="twelve columns"><?= $this->Form->input('password', array('label'=>'Paswoord', 'value'=>'', 'required'=>false)); ?></div>
					<div class="twelve columns"><?= $this->Form->input('role', array(
						'label'=>'Gebruikersrol',
						'options' => array('jury'=>'Jurylid', 'admin'=>'Beheerder')
					)); ?></div>
				</div>
			</fieldset>
			<div class="row">
				<div class="six columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
				<div class="six columns"><?= $this->Html->link('Anuleren', array('action'=>'index'), array('class'=>'radius secondary button')); ?></div>
			</div>
		<?= $this->Form->end(); ?>
	</div>
</div>
