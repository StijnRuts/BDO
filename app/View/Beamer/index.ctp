<form action="" method="POST"  style="margin-top: 60px;">
	<div class="row">
		<div class="six columns offset-by-one">
			<?= $this->Form->input('message', array('label'=>false)); ?>
		</div>
		<div class="five columns">
			<?= $this->Form->submit('Stuur tekst naar beamer', array(
				'class' => 'radius button',
				'style' => 'float:none',
			)); ?>
		</div>
	</div>
</form>

<div class="row">
	<div class="ten columns offset-by-one">
		<form action="<?= Router::url(array('action' => 'uploadImages')); ?>"
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
