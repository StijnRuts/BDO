<div class="row">
	<div class="eight columns" style="margin: 20px 0">
		<h2 style="font-size: 5em">BDO Majoriteitsysteem</h2>
	</div><div class="four columns"></div>
	<div class="eight columns">
		<h2><?= $this->Html->link('Ga naar de beheerders pagina', array('controller'=>'admin')); ?></h2>
	</div><div class="four columns"></div>
	<div class="eight columns">
		<h2><?= $this->Html->link('Ga naar de jury pagina', array('controller'=>'jury')); ?></h2>
	</div><div class="four columns"></div>
	<div class="eight columns">
		<h2><?= $this->Html->link('Toon het scorebord', array('controller'=>'results')); ?></h2>
	</div><div class="four columns"></div>
</div>

<style>
  html, body { min-height: 100%; }
  body { background: url('/css/bdo/bg.png') no-repeat right bottom; }
</style>