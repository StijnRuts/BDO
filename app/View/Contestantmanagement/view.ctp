<div class="row">

	<div class="three columns">
		<ul class="nav-bar vertical">
			<?php foreach ($round['Contestant'] as $c): ?>
			<li class="<?= $c['id']==$contestant['Contestant']['id'] ? 'active' : ''; ?>">
				<?= $this->Html->link(
					h($c['startnr'] .': '. $c['name']),
					array('action'=>'view', $c['id'], $round['Round']['id'])
				); ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="nine columns">
		<div class="row">
			<div class="twelve columns">

				<h2>
					<?= h($contestant['Contestant']['startnr']); ?>:
					<?= h($contestant['Contestant']['name']); ?>
					<small>(
						<?= h($contestant['Discipline']['name']); ?>,
						<?= h($contestant['Category']['name']); ?>,
						<?= h($contestant['Division']['name']); ?>
					)</small>

					<?= $this->Js->link(
						'toon',
						array('controller'=>'results', 'action'=>'showcontestant', $contestant['Contestant']['id']),
						array('title'=>'Toon resultaten van '.h($contestant['Contestant']['name'].' op scorebord'),
							   'class'=>'tiny secondary button')
					); ?>
					<?= $this->Html->link(
						'print',
						array('controller'=>'???', 'action'=>'???', $contestant['Contestant']['id']), /* ??????????????? */
						array('title'=>'Print resultaten van '.h($contestant['Contestant']['name']),
							   'class'=>'tiny secondary button')
					); ?>
				</h2>

				<table>
					<thead>
						<tr>
							<th></th>
							<?php foreach($scores['users'] as $user): ?>
								<th><?= h($user['username']); ?></th>
							<?php endforeach; ?>
							<th>Min</th>
							<th>Max</th>
						</tr>
					</thead>
					<tbody>
						<?php output_rows($scores['points'], 0, $scores['users'], $scores['scores'], $this); ?>
						<tr>
							<th class="name">Totaal</th>
							<?php foreach($scores['users'] as $user): ?>
								<td class="important score"><?= h($scores['scores'][$user['id']]['total']); ?></td>
							<?php endforeach; ?>
							<td class="subfield score">???</td>
							<td class="subfield score">???</td>
						</tr>
					</tbody>
				</table>

				<p>Wordt beoordeeld door: ...</p>

				<div class="buttonbar row">
					<div class="three column"></div>
					<div class="six columns">
						<div class="button split dropdown">
							<?= $this->Html->link(
								'Laat beoordelen door alle juryleden',
								array('controller'=>'???') /* ??????????????????????????????? */
							); ?>
							<span></span>
							<ul>
							<?php foreach($scores['users'] as $user): ?>
								<li>
									<?= $this->Html->link(
										'Laat beoordelen door '.h($user['username']),
										array('controller'=>'???') /* ??????????????????????????????? */
									); ?>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="three column"></div>
				</div>


				<?php
				function output_rows($list, $level, $users, $scores, $t){
					foreach($list as $item){
						echo $t->element('contestantmanagement_row', array(
							'point'=>$item,
							'level'=>$level,
							'users'=>$users,
							'scores'=>$scores
						));
						if( count($item['children'])>0 ) output_rows($item['children'], $level+1, $users, $scores, $t);
					}
				}
				?>


			</div>
		</div>
	</div>

</div>