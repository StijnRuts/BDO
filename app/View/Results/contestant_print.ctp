<h2>
	<?= $round['Contest']['name']; ?>
	<small>(<?= $round['Contest']['date']; ?>)</small>
</h2>
<h2>
	<?= $contestant['Contestant']['startnr']; ?>:
	<?= $contestant['Contestant']['name']; ?>
	<small>(<?= $contestant['Club']['name']; ?>)</small>
</h2>
<h2>
	<?= $contestant['Discipline']['name']; ?>,
	<?= $contestant['Category']['name']; ?>,
	<?= $contestant['Division']['name']; ?>
</h2>

<table>
	<?php if ($showJury): ?>
		<thead>
			<tr>
				<th></th>
				<?php foreach ($scores['users'] as $user): ?>
					<th><?php echo h($user['username']); ?></th>
				<?php endforeach; ?>
				<th>Max</th>
			</tr>
		</thead>
	<?php endif; ?>
	<tbody>
		<?php output_rows($scores['points'], 0, $scores['users'], $scores['scores'], $this); ?>

		<tr id="total">
			<th class="important name">Totaal</th>
			<?php foreach($scores['users'] as $user): ?>
				<td class="important score"><?= h($scores['scores'][$user['id']]['total']); ?></td>
			<?php endforeach; ?>
			<th class="important subfield score"><?= h($scores['maxtotal']) ?></th>
		</tr>

		<tr>
			<th class="important name" style="border-right: 1px solid black;">
				Commentaar
			</th>
			<?php foreach ($scores['users'] as $k => $user): ?>
				<td style="border-right: 1px solid black;">
					<?php
						$comment = nl2br(h($comments[$user['id']]['comment']));
						if (empty($comment)) { $comment = '/'; }
						echo $comment;
					?>
				</td>
			<?php endforeach; ?>
			<th></th>
		</tr>
	</tbody>
</table>

<p><strong>Strafpunten: </strong><?= $scores['strafpunten'] ?></p>
<p><strong>Totaal: </strong><?= $scores['total'] ?></p>

<?php
function output_rows($list, $level, $users, $scores, $t){
	foreach($list as $item){
		echo $t->element('contestantmanagement_row', array(
			'point'=>$item,
			'level'=>$level,
			'users'=>$users,
			'scores'=>$scores,
			'print' => true,
		));
		if( count($item['children'])>0 ) output_rows($item['children'], $level+1, $users, $scores, $t);
	}
}
?>
