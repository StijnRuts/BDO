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

					<span class="nowrap">
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
						array('controller'=>'results', 'action'=>'contest_print',   $contest['Contest']['id'],
						str_replace('/', '-', $contest['Contest']['name'])),
						array('title'=>'Print resultaten van '.h($contest['Contest']['name']),
							   'class'=>'tiny secondary button',
								'target'=>'_blank')
					); ?>
					</span>
				</h2>

				<h3>
					<?= h($round['Discipline']['name']); ?>,
					<?= h($round['Category']['name']); ?>,
					<?= h($round['Division']['name']); ?>

					<span class="nowrap">
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
						array('controller'=>'results', 'action'=>'round_print',   $round['Round']['id'],
								str_replace('/', '-', $contest['Contest']['name']." - ".$round['Discipline']['name'].", ".$round['Category']['name'].", ".$round['Division']['name'])),
						array('title'=>'Print resultaten van deze ronde',
							   'class'=>'tiny secondary button',
							   'target'=>'_blank')
					); ?>
					<?= $this->Form->postLink(
					'wis scores',
						array('action'=>'clearscores', $round['Round']['id']),
						array('title'=>'Wis alle scores voor deze ronde', 'class'=>'tiny alert button'),
						'Weet u zeker dat u alle scores voor deze ronde wilt verwijderen?'
					); ?>
					</span>
				</h3>

				<table>
					<thead>
						<tr>
							<th>Starnr</th>
							<th>Naam</th>
							<th>Jury beoordeling</th>
							<?php /*
							<th>Verpl elem</th>
							<th>Strafp</th>
							<th>Totaal</th>
							*/ ?>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($round['Contestant'] as $contestant): ?>
						<tr>
							<td class="startnr"><strong><?= h($contestant['startnr']); ?></strong></td>
							<td>
								<?= $this->Html->link(
									$contestant['name'],
									array('controller'=>'contestants', 'action'=>'edit', $contestant['id']),
									array('title'=>'Bewerk '.h($contestant['name']), 'class'=>"tablelink")
								); ?>
							</td>
							<td>
								<?php foreach($contestant['scores']['users'] as $user): ?>
								<span class="filler">
									<?php for($i=0; $i<5-strlen(h($contestant['scores']['scores'][$user['id']]['total'])); $i++) echo "0"; ?>
									<?= is_float($contestant['scores']['scores'][$user['id']]['total']) ? '0' : "." ?>
								</span>
								<span class="score <?= $user['id']==$contestant['scores']['min'] ? 'min' : '' ?> <?= $user['id']==$contestant['scores']['max'] ? 'max' : '' ?>">
									<?= h($contestant['scores']['scores'][$user['id']]['total']); ?>
								</span>
								<?php endforeach; ?>
							</td>
							<?php /*
							<td class="score"><?= h($contestant['scores']['verplichtelem']); ?></td>
							<td class="score"><?= h($contestant['scores']['strafpunten']); ?></td>
							<td class="score"><strong><?= h($contestant['scores']['total']); ?></strong></td>
							*/ ?>
							<td>
								<?= $this->Js->link(
									'toon naam',
									array(
										'controller' => 'results',
										'action' => 'showcontestantname',
										$contestant['id'],
										$round['Round']['id'],
									),
									array(
										'title' => 'Toon naam van '.h($contestant['name']).' op scorebord',
										'class' => 'tiny secondary button',
									)
								); ?>
								<?= $this->Js->link(
									'toon',
									array(
										'controller' => 'results',
										'action' => 'showcontestant',
										$contestant['id'],
										$round['Round']['id'],
									),
									array(
										'title' => 'Toon resultaten van '.h($contestant['name'].' op scorebord'),
										'class' => 'tiny secondary button',
									)
								); ?>
								<?= $this->Html->link(
									'print [-]',
									array(
										'controller' => 'results',
										'action' => 'contestant_print',
										$contestant['id'],
										$round['Round']['id'],
										0,
										str_replace('/', '-', $contestant['startnr']." - ".$contestant['name']." - ".$contestant['Club']['name'])
									),
									array(
										'title' => 'Print resultaten van '.h($contestant['name'].', zonder jurynamen'),
										'class' => 'tiny secondary button',
										'target' => '_blank'
									)
								); ?>
								<?= $this->Html->link(
									'print [+]',
									array(
										'controller' => 'results',
										'action' => 'contestant_print',
										$contestant['id'],
										$round['Round']['id'],
										1,
										str_replace('/', '-', $contestant['startnr']." - ".$contestant['name']." - ".$contestant['Club']['name'])
									),
									array(
										'title' => 'Print resultaten van '.h($contestant['name'].', met jurynamen'),
										'class' => 'tiny secondary button',
										'target' => '_blank'
									)
								); ?>
								<?= $this->Html->link(
									'beoordeling',
									array(
										'controller' => 'contestantmanagement',
										'action' => 'view',
										$contestant['id'],
										$round['Round']['id'],
									),
									array(
										'title' => 'Start beoordeling van '.h($contestant['name']),
										'class' => 'tiny button',
									)
								); ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>


				<div style="text-align:center">
				<?= $this->Html->link(
					'Bereken Majoriteit',
					array('controller'=>'majoriteit', 'action'=>'view', $round['Round']['id']),
					array('title'=>'Bereken de Majoriteit voor deze ronde',
						   'class'=>'large button')
				); ?>
				</div>


				<?php if( count($stage)==0 ): ?>
				<h4 style="margin-top:50px">Geen geplande beoordelingen</h4>
				<?php else: ?>
				<h4 style="margin-top:50px">Geplande beoordelingen</h4>
				<table>
					<thead>
						<tr>
							<th>Jurylid</th>
							<th>Deelnemer</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($stage as $s): ?>
						<tr>
							<td><?= h($s['User']['username']) ?></td>
							<td><?= h($s['Contestant']['startnr']) ?>: <?= h($s['Contestant']['name']) ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2" class="tablebutton">
								<?= $this->Html->link('Wis alle geplande beoordelingen',
								array('controller'=>'admin', 'action'=>'clearstage'),
								array('class'=>'small secondary radius button')); ?>
							</td>
						</tr>
					</tfoot>
				</table>
				<?php endif; ?>

			</div>
		</div>
	</div>

</div>