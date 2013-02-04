<h2>Deelnemers voor: <?= $round['Discipline']['name']; ?>, <?= $round['Category']['name']; ?>, <?= $round['Division']['name']; ?></h2>
<table>
	<thead>
		<tr>
			<th>Club Id</th>
			<th>Discipline Id</th>
			<th>Category Id</th>
			<th>Division Id</th>
			<th>Startnr</th>
			<th>Name</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($round['Contestant'] as $contestant): ?>
		<tr>
			<td><?= $contestant['club_id']; ?></td>
			<td><?= $contestant['discipline_id']; ?></td>
			<td><?= $contestant['category_id']; ?></td>
			<td><?= $contestant['division_id']; ?></td>
			<td><?= $contestant['startnr']; ?></td>
			<td><?= $contestant['name']; ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<div class="row"><div class="ten columns centered">
<?= $this->Form->create('Round'); ?>
	<?= $this->Form->input('Contestant', array('class'=>'contestants')); ?>
<?= $this->Form->end('Submit'); ?>
</div></div>

<?= $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
