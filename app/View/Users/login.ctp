<?php if(!$logged_in): ?>
<div class="row">
	<div class="ten columns centered">
		<?= $this->Form->create('User'); ?>
			<fieldset>
				<legend>Inloggen</legend>
				<div class="row">
					<div class="twelve columns"><?= $this->Form->input('username', array(
						'label'=>'Gebruiker',
						'type' => 'select',
						'options' => $usernames,
					)); ?></div>
					<div class="twelve columns"><?= $this->Form->input('password', array('label'=>'Paswoord')); ?></div>
				</div>
			</fieldset>
			<div class="row">
				<div class="six columns"><?= $this->Form->submit('Inloggen', array('class'=>'radius button')); ?></div>
				<div class="six columns"><?= $this->Html->link('Anuleren', array('controller'=>'home'), array('class'=>'radius secondary button')); ?></div>
			</div>
		<?= $this->Form->end(); ?>
	</div>
</div>
<?php else: ?>
	<div class="row">
		<div class="ten columns centered">
			<h1>Hallo <?= $current_user['username']; ?>. U bent reeds ingelogd.</h1>
		</div>
	</div>
<?php endif; ?>