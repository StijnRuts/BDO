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
					<?= $this->Html->link(
						'toon',
						array('controller'=>'???', 'action'=>'???'/*, $contest['Contest']['id']*/),
						array('title'=>'??? voor '.h(/*$contest['Contest']['name']*/'???'),
							   'class'=>'tiny secondary button')
					); ?>
					<?= $this->Html->link(
						'print',
						array('controller'=>'???', 'action'=>'???'/*, $contest['Contest']['id']*/),
						array('title'=>'??? voor '.h(/*$contest['Contest']['name']*/'???'),
							   'class'=>'tiny secondary button')
					); ?>
				</h2>

				<h3>
					<?= $round['Discipline']['name']; ?>,
					<?= $round['Category']['name']; ?>,
					<?= $round['Division']['name']; ?>
					<?= $this->Html->link(
						'toon',
						array('controller'=>'???', 'action'=>'???'/*, $contest['Contest']['id']*/),
						array('title'=>'??? voor '.h(/*$contest['Contest']['name']*/'???'),
							   'class'=>'tiny secondary button')
					); ?>
					<?= $this->Html->link(
						'print',
						array('controller'=>'???', 'action'=>'???'/*, $contest['Contest']['id']*/),
						array('title'=>'??? voor '.h(/*$contest['Contest']['name']*/'???'),
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
							<td class="startnr"><strong><?= $contestant['startnr']; ?></strong></td>
							<td><?= $contestant['name']; ?></td>
							<td></td>
							<td>
								<?= $this->Html->link(
									'toon',
									array('controller'=>'???', 'action'=>'???'/*, $contest['Contest']['id']*/),
									array('title'=>'??? voor '.h(/*$contest['Contest']['name']*/'???'),
										   'class'=>'tiny secondary button')
								); ?>
								<?= $this->Html->link(
									'print',
									array('controller'=>'???', 'action'=>'???'/*, $contest['Contest']['id']*/),
									array('title'=>'??? voor '.h(/*$contest['Contest']['name']*/'???'),
										   'class'=>'tiny secondary button')
								); ?>
								<?= $this->Html->link(
									'beoordeling',
									array('controller'=>'???', 'action'=>'???'/*, $contest['Contest']['id']*/),
									array('title'=>'??? voor '.h(/*$contest['Contest']['name']*/'???'),
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