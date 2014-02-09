<div class="row">
	<div class="twelve columns">

		<h2><?= h($contest['Contest']['name']); ?> (<?= h($contest['Contest']['date']); ?>)</h2>

		<h3>
			<?= h($round['Discipline']['name']); ?>,
			<?= h($round['Category']['name']); ?>,
			<?= h($round['Division']['name']); ?>
		</h3>

		<table>
			<thead>
				<tr>
					<th>Starnr</th>
					<th>Naam</th>
					<th>Jury beoordeling</th>
					<th>Verpl elem</th>
					<th>Strafp</th>
					<th>Totaal</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($round['Contestant'] as $contestant): ?>
				<tr>
					<td class="startnr"><strong><?= h($contestant['startnr']); ?></strong></td>
					<td><?= h($contestant['name']); ?></td>
					<td>
						<?php foreach($contestant['scores']['users'] as $user): ?>
						<span class="filler">
							<?php for($i=0; $i<5-strlen(h($contestant['scores']['scores'][$user['id']]['total'])); $i++) echo "0"; ?>
							<?= is_float($contestant['scores']['scores'][$user['id']]['total']) ? '0' : "." ?>
						</span>
						<span class="score">
							<?= h($contestant['scores']['scores'][$user['id']]['total']); ?>
						</span>
						<?php endforeach; ?>
					</td>
					<td class="score"><?= h($contestant['scores']['verplichtelem']); ?></td>
					<td class="score"><?= h($contestant['scores']['strafpunten']); ?></td>
					<td class="score"><strong><?= h($contestant['scores']['total']); ?></strong></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	</div>
</div>