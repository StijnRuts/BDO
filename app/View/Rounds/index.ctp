<table>
	<thead>
		<tr>
			<th>Bekijk rondes voor:</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contests as $contest): ?>
		<tr>
			<td><?= $this->Html->link(
				h($contest['Contest']['name']).' ('.h($contest['Contest']['date']).')',
				array('action'=>'edit', $contest['Contest']['id']),
				array('escape'=>false, 'title'=>'Bewerk '.h($contest['Contest']['name']))
			); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
