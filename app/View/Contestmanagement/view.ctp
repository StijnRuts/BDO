<div class="row">

	<div class="three columns">
		<ul class="nav-bar vertical">
			<?php foreach ($contest['Round'] as $r): ?>
			<li class="<?= $r['id']==$round['Round']['id'] ? 'active' : ''; ?>">
				<?= $this->Html->link(
					$r['Discipline']['name'].', '.$r['Category']['name'].', '.$r['Division']['name'],
					array('action'=>'view', $r['id'])
				); ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>


	<div class="nine columns">
		<div class="row">
			<div class="twelve columns">

				<h2>
					<?= h($contest['Contest']['name']); ?> (<?= h($contest['Contest']['date']); ?>)
					<?= $this->Js->link(
						'toon naam',
						array('controller'=>'results', 'action'=>'showcontestname', $contest['Contest']['id']),
						array('title'=>'Toon naam van deze wedstrijd op scorebord',
							   'class'=>'tiny secondary button')
					); ?>
					<?= $this->Js->link(
						'toon',
						array('controller'=>'results', 'action'=>'showcontest', $contest['Contest']['id']),
						array('title'=>'Toon resultaten van '.h($contest['Contest']['name'].' op scorebord'),
							   'class'=>'tiny secondary button')
					); ?>
					<?= $this->Html->link(
						'print',
						array('controller'=>'???', 'action'=>'???', $contest['Contest']['id']), /* ??????????????? */
						array('title'=>'Print resultaten van '.h($contest['Contest']['name']),
							   'class'=>'tiny secondary button')
					); ?>
				</h2>

				<h3>
					<?= h($round['Discipline']['name']); ?>,
					<?= h($round['Category']['name']); ?>,
					<?= h($round['Division']['name']); ?>
					<?= $this->Js->link(
						'toon naam',
						array('controller'=>'results', 'action'=>'showroundname', $round['Round']['id']),
						array('title'=>'Toon naam van deze ronde op scorebord',
							   'class'=>'tiny secondary button')
					); ?>
					<?= $this->Js->link(
						'toon',
						array('controller'=>'results', 'action'=>'showround', $round['Round']['id']),
						array('title'=>'Toon resultaten van deze ronde op scorebord',
							   'class'=>'tiny secondary button')
					); ?>
					<?= $this->Html->link(
						'print',
						array('controller'=>'???', 'action'=>'???', $round['Round']['id']), /* ??????????????? */
						array('title'=>'Print resultaten van deze ronde',
							   'class'=>'tiny secondary button')
					); ?>
				</h3>

				<table>
					<thead>
						<tr>
							<th>Starnr</th>
							<th>Naam</th>
							<th>Beoordeling</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($round['Contestant'] as $contestant): ?>
						<tr>
							<td class="startnr"><strong><?= h($contestant['startnr']); ?></strong></td>
							<td><?= h($contestant['name']); ?></td>
							<td></td>
							<td>
								<?= $this->Js->link(
									'toon naam',
									array('controller'=>'results', 'action'=>'showcontestantname', $contestant['id'], $round['Round']['id']),
									array('title'=>'Toon naam van '.h($contestant['name']).' op scorebord',
										   'class'=>'tiny secondary button')
								); ?>
								<?= $this->Js->link(
									'toon',
									array('controller'=>'results', 'action'=>'showcontestant', $contestant['id'], $round['Round']['id']),
									array('title'=>'Toon resultaten van '.h($contestant['name'].' op scorebord'),
										   'class'=>'tiny secondary button')
								); ?>
								<?= $this->Html->link(
									'print',
									array('controller'=>'???', 'action'=>'???', $contestant['id'], $round['Round']['id']), /* ??????????????? */
									array('title'=>'Print resultaten van '.h($contestant['name']),
										   'class'=>'tiny secondary button')
								); ?>
								<?= $this->Html->link(
									'beoordeling',
									array('controller'=>'contestantmanagement', 'action'=>'view', $contestant['id'], $round['Round']['id']),
									array('title'=>'Start beoordeling van '.h($contestant['name']),
										   'class'=>'tiny button')
								); ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>

</div>