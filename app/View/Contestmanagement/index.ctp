<table>
	<thead>
		<tr>
			<th>Beheer wedstrijdverloop voor:</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contests as $contest): ?>
		<tr>
			<td><?= $this->Html->link(
				h($contest['Contest']['name']).' ('.h($contest['Contest']['date']).')',
				array('action'=>'contest', $contest['Contest']['id'])
			); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
