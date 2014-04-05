<h2 style="margin-bottom:0">
	<?= $contestant['Contestant']['startnr']; ?>:
	<?= $contestant['Contestant']['name']; ?>
</h2>
<h2 style="margin-top:0">
	<small>(<?= $contestant['Club']['name']; ?>)</small>
</h2>

<h3 style="margin-top:20px; font-size:1.7em;">
	<span class="nowrap"><?= $contestant['Discipline']['name']; ?>,</span>
	<span class="nowrap"><?= $contestant['Category']['name']; ?>,</span>
	<span class="nowrap"><?= $contestant['Division']['name']; ?></span>
</h3>

<h1 id="scores">
	<small class="heading">Punten:</small>
	<?php foreach($scores['users'] as $user): ?>
		<span class="score <?= $user['id']==$scores['min'] ? 'min' : ''  ?> <?= $user['id']==$scores['max'] ? 'max' : ''  ?>">
			<?= h($scores['scores'][$user['id']]['total']); ?>
		</span>
	<?php endforeach; ?>
</h1>

<?php /*
<h1 id="extra">
	<?php if($scores['verplichtelem'] > 0): ?>
		<small class="heading">Verplichte elementen:</small>
		<span class="score"><?= h($scores['verplichtelem']); ?></span>
		<br />
	<?php endif; ?>
	<?php if($scores['strafpunten'] > 0): ?>
		<small class="heading">Strafpunten:</small>
		<span class="score"><?= h($scores['strafpunten']); ?></span>
	<?php endif; ?>
</h1>
*/ ?>

<h1 id="total">
	<small class="heading">Totaal:</small>
	<span class="total score"><?= h($scores['total']); ?></span>
</h1>
