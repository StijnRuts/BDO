<div class="row">
	<div class="ten columns centered">
		<?php echo $this->Form->create('User', array('enctype'=>"multipart/form-data")); ?>
			<fieldset>
				<legend><?php echo isset($this->data['User']['id']) ? 'Gebruiker bewerken' : 'Gebruiker toevoegen'; ?></legend>
				<div class="three columns image-upload" style="text-align:center">
					<?php
						$src = $this->data['User']['image'];
						$src = $src ? $src : 'fallback.png';
					?>
					<img src="/images/users/<?php echo $src; ?>"
					     class="image-preview"
					     style="margin-bottom:10px"/>
					<?php echo $this->Form->input('image', array(
						'type' => 'file',
						'label' => array(
							'class' => 'radius secondary small button',
							'text' => 'Kies afbeelding',
						),
						'class' => 'image-input',
						'style' => 'display:none',
					)); ?>
				</div>
				<div class="nine columns">
					<?php echo $this->Form->input('id'); ?>
					<div class="row">
						<div class="twelve columns"><?php echo $this->Form->input('number', array('label'=>'Nummer')); ?></div>
						<div class="twelve columns"><?php echo $this->Form->input('username', array('label'=>'Naam')); ?></div>
						<div class="twelve columns"><?php echo $this->Form->input('password', array('label'=>'Paswoord', 'value'=>'', 'required'=>false)); ?></div>
						<div class="twelve columns"><?php echo $this->Form->input('role', array(
							'label' => 'Rol',
							'options' => array('jury'=>'Jurylid', 'admin'=>'Beheerder')
						)); ?></div>
					</div>
				</div>
			</fieldset>
			<div class="row">
				<div class="six columns"><?php echo $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
				<div class="six columns"><?php echo $this->Html->link('Anuleren', array('action'=>'index'), array('class'=>'radius secondary button')); ?></div>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
