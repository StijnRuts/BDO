<div class="row">
	<div class="ten columns centered">
		<?= $this->Form->create('Contestant'); ?>
			<fieldset>
				<legend>Lid toevoegen</legend>
					<div class="row">
						<div class="two columns"><?= $this->Form->input('startnr', array('label'=>'Startnummer') ); ?></div>
						<div class="five columns"><?= $this->Form->input('name', array('label'=>'Naam') ); ?></div>
						<div class="five columns"><?= $this->Form->input('club_id', array('label'=>'Club')); ?></div>
					</div>
					<div class="row">
						<div class="four columns"><?= $this->Form->input('discipline_id', array('label'=>'Discipline') ); ?></div>
						<div class="four columns"><?= $this->Form->input('category_id', array('label'=>'Categrorie') ); ?></div>
						<div class="four columns"><?= $this->Form->input('division_id', array('label'=>'Divisie') ); ?></div>
					</div>
			</fieldset>
			<div class="row">
				<div class="six columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
				<div class="six columns"><?= $this->Html->link('Stoppen', array('action'=>'index'), array('class'=>'radius secondary button')); ?></div>
			</div>
		<?= $this->Form->end(); ?>
	</div>
</div>
