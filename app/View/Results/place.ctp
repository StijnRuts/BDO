<h2><?php echo h($round['Contest']['name']); ?></h2>

<h3>
	<span class="nowrap"><?php echo $round['Discipline']['name']; ?>,</span>
	<span class="nowrap"><?php echo $round['Category']['name']; ?>,</span>
	<span class="nowrap"><?php echo $round['Division']['name']; ?></span>
</h3>

<table>
	<thead>
		<tr>
			<th>Plaats</th>
			<th>Startnr</th>
			<th>Deelnemer</th>
			<th>Club</th>
			<th>Punten</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($round['Contestant'] as $contestant): ?>
		<tr <?php echo $contestant['scores']['rank'] >= $minplace ? "" : 'class="hidden"' ?>>
			<td><?php echo h($contestant['scores']['rank']); ?></td>
			<td><?php echo h($contestant['startnr']); ?></td>
			<td><?php echo h($contestant['name']); ?></td>
			<td><?php echo h($contestant['Club']['name']); ?></td>
			<td class="total score"><?php echo h($contestant['scores']['total']); ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<style> .hidden { display:none; } </style>

<script type="text/javascript">
  $(function() {
    $(".hidden").show();
    $('th').each(function() {
      $(this).width( $(this).width() );
    });
    $(".hidden").hide();
  });
</script>
