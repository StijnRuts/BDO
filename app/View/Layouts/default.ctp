<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css( Configure::read('debug')>0 ? 'jquery-ui/jquery-ui-1.10.0' : 'jquery-ui/jquery-ui-1.10.0.min');
		echo $this->Html->css( Configure::read('debug')>0 ? 'foundation' : 'foundation.min');
		echo $this->Html->css('foundation_icons');
		echo $this->Html->css('tablesorter/style');
		echo $this->Html->css('bdo/all');

		echo $this->Html->script( Configure::read('debug')>0 ? 'jquery-1.9.0' : 'jquery-1.9.0.min');
		echo $this->Html->script( Configure::read('debug')>0 ? 'jquery-ui-1.10.0' : 'jquery-ui-1.10.0.min');
		echo $this->Html->script('foundation/modernizr.foundation.js');
		echo $this->Html->script('foundation/foundation.min.js');
		echo $this->Html->script('foundation/app.js');
		echo $this->Html->script( Configure::read('debug')>0 ? 'jquery-tablesorter' : 'jquery-tablesorter.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="header">
		<?php $navigation = $this->Navigation->get() ?>
		<nav><?= $navigation['breadcrumbs'] ?></nav>
		<nav><?= $navigation['menu'] ?></nav>
	</div>
	<div id="content">
		<?= $this->Session->flash(); ?>
		<?= $this->fetch('content'); ?>
	</div>
	<div id="footer">

	</div>
</body>
</html>
