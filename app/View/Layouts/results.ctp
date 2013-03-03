<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>Scorebord</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css( Configure::read('debug')>0 ? 'foundation' : 'foundation.min');
		echo $this->Html->css('foundation_icons');
		echo $this->Html->css('bdo/all');
		echo $this->Html->css('bdo/results');

		echo $this->Html->script( Configure::read('debug')>0 ? 'jquery-1.9.0' : 'jquery-1.9.0.min');
		echo $this->Html->script('foundation/modernizr.foundation.js');
		echo $this->Html->script('foundation/foundation.min.js');
		echo $this->Html->script('foundation/app.js');
		echo $this->Js->writeBuffer(array('cache'=>true));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<noscript><div id="nojs" class="alert-box alert">
		Om deze site correct te kunnen gebruiken moet u javascript aanzetten.
		(<a href="http://www.enable-javascript.com/nl/" target="_blank">Hoe doe ik dat?</a>)
	</div></noscript>
	<div id="content"><?= $this->fetch('content'); ?></div>
</body>
</html>
