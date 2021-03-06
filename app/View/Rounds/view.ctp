<div class="row">

	<div class="three columns">
		<ul class="nav-bar vertical">
			<?php foreach ($contests as $c): ?>
			<li class="<?php echo $c['Contest']['id']==$contest['Contest']['id'] ? 'active' : ''; ?>">
				<?php echo $this->Html->link(
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

				<h2>Rondes voor <?php echo h($contest['Contest']['name']); ?> <small>(<?php echo h($contest['Contest']['date']); ?>)</small></h2>
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
							<tr id="Round_<?php echo $round['id']; ?>">
								<td class="sorthandle"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></td>
								<td class="sorthandle"><?php echo $round['Discipline']['name']; ?></td>
								<td class="sorthandle"><?php echo $round['Category']['name']; ?></td>
								<td class="sorthandle"><?php echo $round['Division']['name']; ?></td>
								<td>
									<?php echo $this->Html->link(
										'deelnemers',
										array('action'=>'contestants', $round['id']),
										array('title'=>'Beheer deelnemers voor deze ronde',
											   'class'=>'tiny button')
									); ?>
									<?php echo $this->Html->link(
										'jurysamenstelling',
										array('action'=>'users', $round['id']),
										array('title'=>'Beheer jurysamenstelling voor deze ronde',
											   'class'=>'tiny button')
									); ?>
								</td>
								<td>
									<?php echo $this->Html->link(
										'<i class="f-icon-tools"></i>',
										array('controller'=>'rounds', 'action'=>'edit', $round['id']),
										array('escape'=>false, 'title'=>'Bewerk ronde')
									); ?>
									<?php echo $this->Form->postLink(
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
								<?php echo $this->Html->link('Ronde toevoegen',
									array('controller'=>'rounds','action'=>'add', $contest['Contest']['id']),
									array('class'=>'small secondary radius  button')
								); ?>
							</td>
						</tr>
					</tfoot>
				</table>

				<?php $this->Sortable->init('rounds', '#sortable tbody'); ?>

			</div>
		</div>
	</div>

</div>
