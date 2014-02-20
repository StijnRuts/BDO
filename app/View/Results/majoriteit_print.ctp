<h2>
	<?= $round['Contest']['name']; ?>
	<small>(<?= $round['Contest']['date']; ?>)</small>
</h2>
<h2>
	<?= $round['Discipline']['name']; ?>,
	<?= $round['Category']['name']; ?>,
	<?= $round['Division']['name']; ?>
</h2>

<table>
	<thead>
		<tr>
			<th>Starnr</th>
			<th>Deelnemer</th>
			<th>Club</th>
			<th colspan="<?= count($contest['User']) ?>">Ranking per jurylid</th>
			<th>Plaats</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($majoriteit as $contestant): ?>
		<tr>
			<td class="startnr"><?= h($contestant['startnr']); ?></td>
			<td><?= h($contestant['name']); ?></td>
			<td><?= h($contestant['Club']['name']); ?></td>
			<?php foreach($contestant['places'] as $place): ?>
				<td class="score"><?= h($place); ?></td>
			<?php endforeach; ?>
			<td class="score"><?= $contestant['place'] ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>


<br/><br/>


<h3>Berekening</h3>

<table style="margin-top:0">
	<thead>
		<tr>
			<th>Starnr</th>
			<th>Deelnemer</th>
			<?php for ($i=1; $i<=count($majoriteit); $i++): ?>
				<th style="text-align:right"><?= ($i==1?"":"1-").h($i) ?></th>
			<?php endfor; ?>
			<th>Plaats</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($majoriteit as $contestant): ?>
		<tr>
			<td class="startnr"><?= h($contestant['startnr']); ?></td>
			<td><?= h($contestant['name']); ?></td>
			<?php for ($i=1; $i<=count($majoriteit); $i++): ?>
				<td class="score">
					<?php if($contestant['plaatsing'][$i]['cumulative']==0): ?>
						-
					<?php else: ?>
						<?= h($contestant['plaatsing'][$i]['cumulative']) ?>
						<?php for($j=0; $j<2-strlen(h($contestant['plaatsing'][$i]['sum'])); $j++) echo "&nbsp;"; ?>
						<span style="color:#777">(<?= h($contestant['plaatsing'][$i]['sum']) ?>)</span>
					<?php endif; ?>
				</td>
			<?php endfor; ?>
			<td class="score"><?= $contestant['place'] ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>