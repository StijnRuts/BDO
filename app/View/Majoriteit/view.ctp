<div class="row">
	<div class="twelve columns">

		<h2><?php echo h($contest['Contest']['name']); ?> (<?php echo h($contest['Contest']['date']); ?>)</h2>

		<h3>
			<?php echo h($round['Discipline']['name']); ?>,
			<?php echo h($round['Category']['name']); ?>,
			<?php echo h($round['Division']['name']); ?>

			<?php echo $this->Html->link(
				'print',
				array('controller'=>'results', 'action'=>'majoriteit_print',   $round['Round']['id'],
				str_replace('/', '-', $contest['Contest']['name']." - ".$round['Discipline']['name'].", "
					                 .$round['Category']['name'].", ".$round['Division']['name']).' (majoriteit)'),
				array('title'=>'Print majoriteit',
					   'class'=>'tiny secondary button', 'target'=>'_blank')
			); ?>
		</h3>

		<table>
			<thead>
				<tr>
					<th rowspan="2">Starnr</th>
					<th rowspan="2">Naam</th>
					<th rowspan="2" colspan="<?php echo count($round['User']) ?>">Ranking per jurylid</th>
					<th rowspan="2"></th>
					<th colspan="<?php echo count($majoriteit) ?>">Plaatsbepaling</th>
					<th rowspan="2">Uitslag</th>
				</tr><tr>
					<?php for ($i=1; $i<=count($majoriteit); $i++): ?>
						<th style="text-align:right"><?php echo ($i==1?"":"1-").h($i) ?></th>
					<?php endfor; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($majoriteit as $contestant): ?>
				<tr>
					<td class="startnr"><strong><?php echo h($contestant['startnr']); ?></strong></td>
					<td><?php echo h($contestant['name']); ?></td>
					<?php foreach($contestant['places'] as $place): ?>
						<td class="score"><?php echo h($place); ?></td>
					<?php endforeach; ?>
					<td><?php echo $this->Js->link(
						'toon',
						array('controller'=>'results', 'action'=>'showcontestantmajoriteit', $contestant['id'], $round['Round']['id']),
						array('title'=>'Toon ranking van '.h($contestant['name'].' op scorebord'),
							   'class'=>'tiny secondary button')
					); ?></td>
					<?php for ($i=1; $i<=count($majoriteit); $i++): ?>
						<td class="score">
							<?php if($contestant['plaatsing'][$i]['cumulative']==0): ?>
								-
							<?php else: ?>
								<strong><?php echo h($contestant['plaatsing'][$i]['cumulative']) ?></strong>
								<?php for($j=0; $j<2-strlen(h($contestant['plaatsing'][$i]['sum'])); $j++) echo "&nbsp;"; ?>
								<span style="color:#777">(<?php echo h($contestant['plaatsing'][$i]['sum']) ?>)</span>
							<?php endif; ?>
						</td>
					<?php endfor; ?>
					<td class="score"><strong><?php echo $contestant['place'] ?></strong></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>


		<?php
			$places = array();
			$startnrs = array();
			foreach ($majoriteit as $contestant) {
				$places[] = $contestant['place'];
				$startnrs[ $contestant['startnrorder'] ] = $contestant['startnr'];
			}
			$places = array_unique($places);
			sort($places);
			ksort($startnrs);
		?>

		<div style="text-align:center"><div style="display:inline-block; text-align:left">
			<div id="placebuttons">
				<span style="display: inline-block; width:8em;">
					Toon op plaats:
				</span>
				<?php echo $this->Js->link(
					"leeg",
					array('controller'=>'results', 'action'=>'showmajoriteit', $round['Round']['id'], end($places)+1),
					array('title'=>"Toon geen enkel resultaat op het scorebord",
						   'class'=>'small secondary button nothingbutton')
				); ?>
				<?php foreach (array_reverse($places) as $place): ?>
					<?php echo $this->Js->link(
						$place,
						array('controller'=>'results', 'action'=>'showmajoriteit', $round['Round']['id'], $place),
						array('title'=>"Toon de resultaten vanaf plaats $place op het scorebord",
							   'class'=>'small secondary button')
					); ?>
				<?php endforeach; ?>
			</div>
			<br/>
			<div id="startnrbuttons">
				<span style="display: inline-block; width:8em;">
					Toon op startnr:
				</span>
				<?php echo $this->Js->link(
					"leeg",
					array('controller'=>'results', 'action'=>'showmajoriteitstartnr', $round['Round']['id'], end($startnrs)+1),
					array('title'=>"Toon geen enkel resultaat op het scorebord",
						   'class'=>'small secondary button nothingbutton')
				); ?>
				<?php foreach ($startnrs as $order=>$startnr): ?>
					<?php echo $this->Js->link(
						$startnr,
						array('controller'=>'results', 'action'=>'showmajoriteitstartnr', $round['Round']['id'], $order),
						array('title'=>"Toon de resultaten tot startnr $startnr op het scorebord",
							   'class'=>'small secondary button')
					); ?>
				<?php endforeach; ?>
			</div>
		</div></div>

		<script type="text/javascript">
		$(function(){
			$("#placebuttons a, #startnrbuttons a").click(function() {
				$("#placebuttons a, #startnrbuttons a").addClass("secondary");
				$(this).removeClass("secondary");
				$(this).prevAll().removeClass("secondary");
				$(".nothingbutton").addClass("secondary");
			});
		});
		</script>

	</div>
</div>
