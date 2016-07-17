<table>
	<thead>
		<tr>
			<th>Nummer</th>
			<th>Naam</th>
			<th>Rol</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo h($user['User']['number']); ?></td>
			<td><?php echo h($user['User']['username']); ?></td>
			<td><?php switch($user['User']['role']){
				case 'admin': echo 'Beheerder'; break;
				case 'jury':  echo 'Jurylid'; break;
				default: echo '<div class="alert label">!!! Onbekend !!!</div>'; break;
			} ?></td>
			<td>
				<?php echo $this->Html->link(
					'<i class="f-icon-tools"></i>',
					array('action'=>'edit', $user['User']['id']),
					array('escape'=>false, 'title'=>'Bewerk '.h($user['User']['username']))
				); ?>
				<?php echo $this->Form->postLink(
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
			<td colspan="4" class="tablebutton">
				<?php echo $this->Html->link('Gebruiker toevoegen', array('action'=>'add'), array('class'=>'small secondary radius button')); ?>
			</td>
		</tr>
	</tfoot>
</table>
