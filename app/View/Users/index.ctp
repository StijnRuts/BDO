<table>
	<thead>
		<tr>
			<th>Gebruikersnaam</th>
			<th>Gebruikersrol</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user): ?>
		<tr>
			<td><?= h($user['User']['username']); ?></td>
			<td><?php switch($user['User']['role']){
				case 'admin': echo 'Beheerder'; break;
				case 'jury':  echo 'Jurylid'; break;
				default: echo '<div class="alert label">!!! Onbekend !!!</div>'; break;
			} ?></td>
			<td>
				<?= $this->Html->link(
					'<i class="f-icon-tools"></i>',
					array('action'=>'edit', $user['User']['id']),
					array('escape'=>false, 'title'=>'Bewerk '.h($user['User']['username']))
				); ?>
				<?= $this->Form->postLink(
					'<i class="f-icon-remove"></i>',
					array('action'=>'delete', $user['User']['id']),
					array('escape'=>false, 'title'=>'Verwijder '.h($user['User']['username'])),
					'Weet u zeker dat u '.h($user['User']['username']).' wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3" class="tablebutton">
				<?= $this->Html->link('Gebruiker toevoegen', array('action'=>'add'), array('class'=>'small secondary radius button')); ?>
			</td>
		</tr>
	</tfoot>
</table>
