<div class="row">
	<div class="twelve columns">

		<h2><?= h($contest['Contest']['name']); ?> (<?= h($contest['Contest']['date']); ?>)</h2>

		<h3>
			<?= h($round['Discipline']['name']); ?>,
			<?= h($round['Category']['name']); ?>,
			<?= h($round['Division']['name']); ?>
		</h3>

		<?php /*
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
		*/ ?>

		<table>
			<thead>
				<tr>
					<th rowspan="2">Starnr</th>
					<th rowspan="2">Naam</th>
					<th rowspan="2" colspan="<?= count($contest['User']) ?>">Ranking per jurylid</th>
					<th colspan="<?= count($majoriteit) ?>">Plaatsbepaling</th>
					<th rowspan="2">Uitslag</th>
				</tr><tr>
					<?php for ($i=1; $i<=count($majoriteit); $i++): ?>
						<th style="text-align:right"><?= ($i==1?"":"1-").h($i) ?></th>
					<?php endfor; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($majoriteit as $contestant): ?>
				<tr>
					<td class="startnr"><strong><?= h($contestant['startnr']); ?></strong></td>
					<td><?= h($contestant['name']); ?></td>
					<?php foreach($contestant['places'] as $place): ?>
						<td class="score"><?= h($place); ?></td>
					<?php endforeach; ?>
					<?php for ($i=1; $i<=count($majoriteit); $i++): ?>
						<td class="score">
							<?php if($contestant['plaatsing'][$i]['cumulative']==0): ?>
								-
							<?php else: ?>
								<strong><?= h($contestant['plaatsing'][$i]['cumulative']) ?></strong>
								<?php for($j=0; $j<2-strlen(h($contestant['plaatsing'][$i]['sum'])); $j++) echo "&nbsp;"; ?>
								<span style="color:#777">(<?= h($contestant['plaatsing'][$i]['sum']) ?>)</span>
							<?php endif; ?>
						</td>
					<?php endfor; ?>
					<td class="score"><strong><?= $contestant['place'] ?></strong></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	</div>
</div>