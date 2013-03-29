<?php
$monthnames = array();
$monthnames['01'] = 'Januari';
$monthnames['02'] = 'Februari';
$monthnames['03'] = 'Maart';
$monthnames['04'] = 'April';
$monthnames['05'] = 'Mei';
$monthnames['06'] = 'Juni';
$monthnames['07'] = 'Juli';
$monthnames['08'] = 'Augustus';
$monthnames['09'] = 'September';
$monthnames['10'] = 'Oktober';
$monthnames['11'] = 'November';
$monthnames['12'] = 'December';
?>

<div class="row">
	<div class="ten columns centered">
		<?= $this->Form->create('Contest'); ?>
			<fieldset>
				<legend>Wedstrijd bewerken</legend>
				<?= $this->Form->input('id'); ?>
					<div class="row">
						<div class="twelve columns"><?= $this->Form->input('date', array(
							'label'=>'Datum',
							'dateFormat'=>'DMY',
							'monthNames'=>$monthnames,
							'minYear' => date('Y') - 3,
    						'maxYear' => date('Y') + 10
						) ); ?></div>
					</div>
					<div class="row">
						<div class="twelve columns"><?= $this->Form->input('name', array('label'=>'Wedstrijdnaam') ); ?></div>
					</div>
			</fieldset>
			<div class="row">
				<div class="six columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
				<div class="six columns"><?= $this->Html->link('Anuleren', array('action'=>'index'), array('class'=>'radius secondary button')); ?></div>
			</div>
		<?= $this->Form->end(); ?>
	</div>
</div>
