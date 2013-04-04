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

<div class="row buttonbar">
	<div class="two columns"></div>
	<div class="four columns">
		<?= $this->Html->link('Wis alle geplande beoordelingen', array('action'=>'clearstage'), array('class'=>'secondary radius button')); ?>
	</div>
	<div class="six columns"></div>
</div>

<style> body { min-height: 100%; background: url('/css/bdo/bg.png') no-repeat right top; } </style>