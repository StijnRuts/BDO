<style type="text/css">
	.place {

		text-align: center;
	}
</style>

<?php /* <h2><?= h($round['Contest']['name']); ?></h2> */ ?>

<h3>
	<span class="nowrap"><?= $round['Discipline']['name']; ?>,</span>
	<span class="nowrap"><?= $round['Category']['name']; ?>,</span>
	<span class="nowrap"><?= $round['Division']['name']; ?></span>
</h3>

<table class="majoriteit">
	<thead>
		<tr>
			<th>Startnr</th>
			<?php /* <th>Deelnemer</th> */ ?>
			<?php foreach($users as $key => $user): ?>
				<th><?php echo 'Jury '.($key+1); /*h($user['username']);*/ ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($majoriteit as $contestant): ?>
		<tr <?= $contestant['startnrorder']<=$startnr ? "" : 'class="hidden"' ?>>
			<td><strong><?= h($contestant['startnr']); ?></strong></td>
			<?php /* <td><?= h($contestant['name']); ?></td> */ ?>
			<?php foreach($contestant['places'] as $place): ?>
				<td class="place"><?= h($place); ?></td>
			<?php endforeach; ?>
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
