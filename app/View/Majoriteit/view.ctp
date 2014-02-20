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


		<?php
			$places = array();
			foreach ($majoriteit as $contestant) $places[] = $contestant['place'];
			$places = array_unique($places);
			sort($places);
		?>

		<div style="text-align:center">
			<?= $this->Js->link(
				"Toon leeg scorebord",
				array('controller'=>'results', 'action'=>'showmajoriteit', $round['Round']['id'], end($places)+1),
				array('title'=>"Toon geen enkel resultaat op het scorebord",
					   'class'=>'small button', 'id'=>'nothingbutton')
			); ?>
			&nbsp;
			<?= $this->Js->link(
				"Toon alle resultaten",
				array('controller'=>'results', 'action'=>'showmajoriteit', $round['Round']['id'], 1),
				array('title'=>"Toon alle resultaten op het scorebord",
					   'class'=>'small button', 'id'=>'allbutton')
			); ?>
			&nbsp;
			<ul id="nextbuttons" style="list-style:none; display:inline-block">
			<?php foreach ($places as $place): ?>
				<li style="display:none"><?= $this->Js->link(
					"Toon volgende plaats op scorebord",
					array('controller'=>'results', 'action'=>'showmajoriteit', $round['Round']['id'], $place),
					array('title'=>"Toon de resultaten vanaf plaats $place op het scorebord",
						   'class'=>'button')
				); ?></li>
			<?php endforeach; ?>
			</ul>
		</div>

		<script type="text/javascript">
		$(function(){

			$("#nextbuttons li").last().show();

			$("#nextbuttons li a").click(function(){
				$(this).parent().hide();
				$(this).parent().prev().show();
			});

			$("#nothingbutton").click(function(){
				$("#nextbuttons li").hide();
				$("#nextbuttons li").last().show();
			});

			$("#allbutton").click(function(){
				$("#nextbuttons li").hide();
			});

		});
		</script>

	</div>
</div>