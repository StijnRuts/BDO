<tr class="level<?= $level; ?>">
	<th class="name"><?= h($point['Point']['name']); ?></th>

	<td class="scoreinput">
		<?= $this->Form->input('Score.'.$form_id.'.score', array(
			'type'=>'text',
			'size'=>4,
			'label'=>false,
			'autocomplete'=>"off",
			'data-plus-as-tab'=>"true"
		)); ?>
		<?= $this->Form->input('Score.'.$form_id.'.id', array('type'=>'hidden')); ?>
	</td>

	<td class="subfield score"><?= h($point['Point']['max']); ?></td>
</tr>

