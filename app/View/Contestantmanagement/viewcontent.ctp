<table>
	<thead>
		<tr>
			<th></th>
			<?php foreach($scores['users'] as $user): ?>
				<th><?= h($user['username']); ?></th>
			<?php endforeach; ?>
			<th>Max</th>
		</tr>
	</thead>
	<tbody>
		<?php output_rows($scores['points'], 0, $scores['users'], $scores['scores'], $this); ?>
		<tr>
			<th class="important name">Totaal</th>
			<?php foreach($scores['users'] as $user): ?>
				<td class="important score"><?= h($scores['scores'][$user['id']]['total']); ?></td>
			<?php endforeach; ?>
			<td class="important subfield score"><?= h($scores['maxtotal']) ?></td>
		</tr>
		<?php /*
		<tr>
			<th class="important name">Strafpunten</th>
			<td class="important score"><?= h($scores['strafpunten']) ?></td>
			<td class="important" colspan="<?= count($scores['users']) ?>"></td>
		</tr>
		<tr>
			<th class="important name">Eindtotaal</th>
			<td class="important score"><?= h($scores['total']) ?></td>
			<td class="important" colspan="<?= count($scores['users']) ?>"></td>
		</tr>
		*/ ?>
	</tbody>
</table>

<p id="judgedby"><?php
	if( count($staged)>0 ){
		$users = array();
		foreach($staged as $s) $users[] = h($s['User']['username']);
		echo 'Wordt beoordeeld door: '.join(', ',$users);
	} else {
		echo 'Wordt momenteel niet beoordeeld';
	}
?></p>


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
