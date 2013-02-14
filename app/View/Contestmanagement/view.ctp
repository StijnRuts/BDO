<table>
	<thead>
		<tr>
			<th><h2><?= h($contest['Contest']['name']); ?> <small>(<?= h($contest['Contest']['date']); ?>)</small></h2></th>
			<th>
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
			</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contest['Round'] as $round): ?>
		<tr>
			<th>
				<?= $round['Discipline']['name']; ?>,
				<?= $round['Category']['name']; ?>,
				<?= $round['Division']['name']; ?>
			</th>
			<th>
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
			</th>
		</tr>
		<tr><td colspan="2">


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


		</td></tr>
		<?php endforeach; ?>
	</tbody>
</table>