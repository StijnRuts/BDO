<h2>Stuur een tekst naar de beamer</h2>

<form action="<?= Router::url(array('action' => 'setMessage')); ?>" method="POST">
	<div class="row">
		<div class="ten columns centered">
			<div class="ten columns">
				<?= $this->Form->input('message', array('label'=>false)); ?>
			</div>
			<div class="two columns">
				<?= $this->Form->submit('Verstuur', array(
					'class' => 'radius button',
					'style' => 'float:none',
				)); ?>
			</div>
		</div>
	</div>
</form>

<br><br>

<h2>Kies logo's voor de beamer</h2>

<div class="row">
	<div class="ten columns centered">
		<ul id="sortable" class="image_previews">
			<?php foreach ($scoreboardImages as $scoreboardImage): ?>
				<li id="ScoreboardImage_<?php echo $scoreboardImage['ScoreboardImage']['id']; ?>"
					class="image_preview scoreboard">
					<img src="/images/scoreboard/<?php echo $scoreboardImage['ScoreboardImage']['name']; ?>" />
					<?php echo $this->Form->postLink(
						'<i class="f-icon-remove"></i>',
						array(
							'controller' => 'ScoreboardImage',
							'action' => 'delete',
							$scoreboardImage['ScoreboardImage']['id'],
						),
						array(
							'escape' => false,
							'title' => 'Verwijder afbeelding',
							'style' => 'position:relative',
						)
					); ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<div class="row">
	<div class="ten columns offset-by-one">
		<form action="<?= Router::url(array(
				'controller' => 'ScoreboardImage',
				'action' => 'add',
			)); ?>"
			method="POST" enctype="multipart/form-data"
			class="dropzone" id="scoreboardDropzone">
			<div class="fallback">
				<input name="file[]" type="file" multiple />
				<?= $this->Form->submit('Verstuur', array(
					'class' => 'radius button',
					'style' => 'float:none',
				)); ?>
		  </div>
		</form>
	</div>
</div>

<?php $this->Sortable->init('ScoreboardImage', '#sortable', null); ?>
