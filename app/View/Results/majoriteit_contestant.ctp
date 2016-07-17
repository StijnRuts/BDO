<style type="text/css">
	.place {
		font-size: 2.5em;
		padding: 16px;
		text-align: center;
	}
</style>

<?php foreach ($majoriteit as $contestant): ?>
	<?php if($contestant['id'] == $contestantid): ?>

<br/>

		<h2 style="margin-bottom:0">
			<?= $contestant['startnr']; ?>:
			<?= $contestant['name']; ?>
		</h2>
		<h2 style="margin-top:0">
			<small>(<?= $contestant['Club']['name']; ?>)</small>
		</h2>

		<table class="places_large">
			<thead>
				<tr>
					<?php foreach($users as $key => $user): ?>
						<th><?php echo 'Jury '.($key+1); /*h($user['username']);*/ ?></th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php foreach($contestant['places'] as $place): ?>
						<td class="place"><strong><?= h($place); ?></strong></td>
					<?php endforeach; ?>
				</tr>
			</tbody>
		</table>

	<?php endif; ?>
<?php endforeach; ?>
