<h2>
	<?= h($contestant['Contestant']['startnr']); ?>:
	<?= h($contestant['Contestant']['name']); ?>
	<small>(
		<?= h($contestant['Discipline']['name']); ?>,
		<?= h($contestant['Category']['name']); ?>,
		<?= h($contestant['Division']['name']); ?>
	)</small>
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
