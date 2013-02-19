<div class="row">

	<div class="three columns">
		<ul class="nav-bar vertical">
			<?php foreach ($contests as $c): ?>
			<li class="<?= $c['Contest']['id']==$contest['Contest']['id'] ? 'active' : ''; ?>">
				<?= $this->Html->link(
					$c['Contest']['name'],
					array('action'=>'view', $c['Contest']['id'])
				); ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="nine columns">
		<div class="row">
			<div class="twelve columns">

				<h2>Rondes voor <?= h($contest['Contest']['name']); ?> <small>(<?= h($contest['Contest']['date']); ?>)</small></h2>
				<table id="sortable">
					<thead>
						<tr>
							<th></th>
							<th>Discipline</th>
							<th>Categorie</th>
							<th>Divisie</th>
							<th>Beheer</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($contest['Round'] as $round): ?>
							<tr id="Round_<?= $round['id']; ?>">
								<td class="sorthandle"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></td>
								<td class="sorthandle"><?= $round['Discipline']['name']; ?></td>
								<td class="sorthandle"><?= $round['Category']['name']; ?></td>
								<td class="sorthandle"><?= $round['Division']['name']; ?></td>
								<td>
									<?= $this->Html->link(
										'deelnemers',
										array('controller'=>'rounds', 'action'=>'contestants', $round['id']),
										array('title'=>'Beheer deelnemers voor deze ronde',
											   'class'=>'tiny secondary button')
									); ?>
								</td>
								<td>
									<?= $this->Html->link(
										'<i class="f-icon-tools"></i>',
										array('controller'=>'rounds', 'action'=>'edit', $round['id']),
										array('escape'=>false, 'title'=>'Bewerk ronde')
									); ?>
									<?= $this->Form->postLink(
										'<i class="f-icon-remove"></i>',
										array('controller'=>'rounds', 'action'=>'delete', $round['id']),
										array('escape'=>false, 'title'=>'Verwijder ronde'),
										'Weet u zeker dat u deze ronde wilt verwijderen?'
									); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6" class="tablebutton">
								<?= $this->Html->link('Ronde toevoegen',
									array('controller'=>'rounds','action'=>'add', $contest['Contest']['id']),
									array('class'=>'small secondary radius  button')
								); ?>
							</td>
						</tr>
					</tfoot>
				</table>

				<?php $this->Sortable->init('rounds'); ?>

			</div>
		</div>
	</div>

</div>