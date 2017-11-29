<h2><?= h($round['Contest']['name']); ?></h2>

<h3>
	<span class="nowrap"><?= $round['Discipline']['name']; ?>,</span>
	<span class="nowrap"><?= $round['Category']['name']; ?>,</span>
	<span class="nowrap"><?= $round['Division']['name']; ?></span>
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
	<?php foreach($round['Contestant'] as $contestant): ?>
		<tr <?= $contestant['startnrorder']<=$startnr ? "" : 'class="hidden"' ?>>
			<td><?= h($contestant['scores']['rank']); ?></td>
			<td><?= h($contestant['startnr']); ?></td>
			<td><?= h($contestant['name']); ?></td>
			<td><?= h($contestant['Club']['name']); ?></td>
			<td class="total score"><?= h($contestant['scores']['total']); ?></td>
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

    //hide the first rows to make shure the last row fits on the screen
    while(true) {
      var rowBottom = $("tr:visible").last().offset().top + $("tr:visible").last().height();
      var windowBottom = $(window).scrollTop() + $(window).height();
      if(rowBottom < windowBottom) break;
      $("tr:visible").first().hide();
    }
  });
</script>
