<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.specific');
		echo $this->Html->css( Configure::read('debug')>0 ? 'jquery-ui/jquery-ui-1.10.0' : 'jquery-ui/jquery-ui-1.10.0.min');
		echo $this->Html->css( Configure::read('debug')>0 ? 'foundation' : 'foundation.min');
		echo $this->Html->css('foundation_icons');
		echo $this->Html->css('tablesorter/style');
		echo $this->Html->css('dropzone');
		echo $this->Html->css('bdo/all');

		echo $this->Html->script( Configure::read('debug')>0 ? 'jquery-1.9.0' : 'jquery-1.9.0.min');
		echo $this->Html->script('foundation/modernizr.foundation.js');
		echo $this->Html->script('foundation/foundation.min.js');
		echo $this->Html->script('foundation/app.js');
		echo $this->Html->script( Configure::read('debug')>0 ? 'jquery-ui-1.10.0' : 'jquery-ui-1.10.0.min');
		echo $this->Html->script( Configure::read('debug')>0 ? 'jquery-tablesorter' : 'jquery-tablesorter.min');
		echo $this->Html->script( Configure::read('debug')>0 ? 'dropzone' : 'dropzone.min');
		echo $this->Html->script('bdo/alerts');
		echo $this->Html->script('bdo/input_focus');
		echo $this->Html->script('bdo/close_dropdown');
		echo $this->Html->script('bdo/dropzone_options');
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

	<div id="header">
		<?php $navigation = $this->Navigation->get() ?>
		<nav id="breadcrumbbar">
			<?= $navigation['breadcrumbs'] ?>
			<?= $logged_in ?
				$this->Html->Link('Log uit '.$current_user['username'],
											array('controller'=>'users', 'action'=>'logout'),
											array('class'=>'small button', 'id'=>'login')
										) :
				$this->Html->Link('Log in', array('controller'=>'users', 'action'=>'login'),
													 array('class'=>'small button', 'id'=>'login'))
			; ?>
		</nav>
		<nav id="menubar"><?= $navigation['menu'] ?></nav>
	</div>

	<div class="row"><div class="twelve columns"><?= $this->Session->flash(); ?></div></div>
	<div class="row"><div class="twelve columns"><?= $logged_in ? $this->Session->flash('auth') : ''; ?></div></div>
	<div id="content"><?= $this->fetch('content'); ?></div>

</body>
</html>
