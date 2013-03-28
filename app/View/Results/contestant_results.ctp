<h2>
	<?= $contestant['Contestant']['startnr']; ?>:
	<?= $contestant['Contestant']['name']; ?>
	<small>(<?= $contestant['Club']['name']; ?>)</small>
</h2>

<h3>
	<?= $contestant['Discipline']['name']; ?>,
	<?= $contestant['Category']['name']; ?>,
	<?= $contestant['Division']['name']; ?>
</h3>

<h1 id="scores">
	<span class="heading">Punten:</span>
	<?php foreach($scores['users'] as $user): ?>
		<span class="score <?= $user['id']==$scores['min'] ? 'min' : ''  ?> <?= $user['id']==$scores['max'] ? 'max' : ''  ?>">
			<?= h($scores['scores'][$user['id']]['total']); ?>
		</span>
	<?php endforeach; ?>
</h1>

<?php if($scores['strafpunten'] > 0): ?>
	<h1 id="strafpunten">
		<span class="heading">Strafpunten:</span>
		<span class="score"><?= h($scores['strafpunten']); ?></span>
	</h1>
<?php endif; ?>

<h1 id="total">
	<span class="heading">Totaal:</span>
	<span class="total score"><?= h($scores['total']); ?></span>
</h1>
