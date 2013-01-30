<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake');
		echo $this->Html->css( Configure::read('debug')>0 ? 'jquery-ui/jquery-ui-1.10.0' : 'jquery-ui/jquery-ui-1.10.0.min');
		echo $this->Html->css( Configure::read('debug')>0 ? 'foundation' : 'foundation.min');

		echo $this->Html->script( Configure::read('debug')>0 ? 'jquery-1.9.0' : 'jquery-1.9.0.min');
		echo $this->Html->script( Configure::read('debug')>0 ? 'jquery-ui-1.10.0' : 'jquery-ui-1.10.0.min');
		echo $this->Html->script('foundation/modernizr.foundation.js');
		echo $this->Html->script('foundation/foundation.min.js');
		echo $this->Html->script('foundation/app.js');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="header">

	</div>
	<div id="content">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</div>
	<div id="footer">

	</div>
</body>
</html>
