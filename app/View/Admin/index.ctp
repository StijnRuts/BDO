<div class="row">
	<div class="eight columns" style="margin: 20px 0">
		<h2 style="font-size: 5em">Beheerders pagina</h2>
	</div><div class="four columns"></div>
	<div class="eight columns">
		<h2><?= $this->Html->link('Ga naar wedstrijdbeheer', array('action'=>'wedstrijdbeheer')); ?></h2>
	</div><div class="four columns"></div>
	<div class="eight columns">
		<h2><?= $this->Html->link('Ga naar ledenbeheer', array('action'=>'ledenbeheer')); ?></h2>
	</div><div class="four columns"></div>
	<div class="eight columns">
		<h2><?= $this->Html->link('Ga naar gebruikersbeheer', array('controller'=>'users')); ?></h2>
	</div><div class="four columns"></div>
	<div class="eight columns">
		<h2><?= $this->Html->link('Ga naar de instellingen', array('action'=>'instellingen')); ?></h2>
	</div><div class="four columns"></div>
</div>

<form action="" method="POST"  style="margin-top: 60px;">
	<div class="row">
		<div class="six columns offset-by-one">
			<?= $this->Form->input('message', array('label'=>false) ); ?>
		</div>
	<div class="row">
	</div>
		<div class="six columns offset-by-one">
			<?= $this->Form->submit('Stuur naar beamer', array('class'=>'radius button')); ?>
		</div>
	</div>
</form>

<style> body { min-height: 100%; background: url('/css/bdo/bg.png') no-repeat right top; } </style>