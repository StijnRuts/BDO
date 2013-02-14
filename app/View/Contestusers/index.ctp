<table>
	<thead>
		<tr>
			<th>Bekijk de jury van:</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contests as $contest): ?>
		<tr>
			<td><?= $this->Html->link(
				h($contest['Contest']['name']).' ('.h($contest['Contest']['date']).')',
				array('action'=>'edit', $contest['Contest']['id'])
			); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
