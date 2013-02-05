<h2>
	Deelnemers voor ronde <?= $round['Round']['order']; ?>
	<small>(<?= $round['Discipline']['name']; ?>, <?= $round['Category']['name']; ?>, <?= $round['Division']['name']; ?>)</small>
</h2>
<?= $this->Form->create('Round'); ?>
<table class="tablesorter selectable">
	<thead>
		<tr>
			<th></th>
			<th>Startnr</th>
			<th>Naam</th>
			<th>Club</th>
			<th>Discipline</th>
			<th>Categorie</th>
			<th>Divisie</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contestants as $contestant): ?>
		<tr>
			<td><?= $this->Form->checkbox('', array(
				'checked' => in_array($contestant['Contestant']['id'], $selected),
				'name' => 'Contestant['.$contestant['Contestant']['id'].']',
				'value' => $contestant['Contestant']['id'],
				'hiddenField' => false,
				'id' => null
			)); ?></td>
			<td class="startnr"><?= h($contestant['Contestant']['startnr']); ?></td>
			<td><?= h($contestant['Contestant']['name']); ?></td>
			<td><?= h($contestant['Club']['name']); ?></td>
			<td><?= h($contestant['Discipline']['name']); ?></td>
			<td><?= h($contestant['Category']['name']); ?></td>
			<td><?= h($contestant['Division']['name']); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<div class="row">
	<div class="six columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
	<div class="six columns"><?= $this->Html->link('Anuleren',
		array('controller'=>'contests', 'action'=>'rounds', $round['Round']['contest_id']),
		array('class'=>'radius secondary button')
	); ?></div>
</div>
<?= $this->Form->end(); ?>

<script>
	$(document).ready(function(){
		$.tablesorter.addParser({
			id: 'startnr',
			is: function(s){ return false; },
			format: function(s){ return s.toUpperCase(); },
			type: 'text'
		});
		$(".tablesorter").tablesorter({
			headers: {
				0: {sorter: false},
				1: {sorter: 'startnr'}
			}
		});

		$('tbody tr').on('click', function(){
			var checkbox = $(this).find('input[type=checkbox]');
			checkbox.prop("checked", !checkbox.prop("checked"));
		});
	});
</script>
