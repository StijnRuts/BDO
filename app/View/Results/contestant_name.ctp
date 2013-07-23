<div id="infopage"></div>

<h2>
	<?= $contestant['Contestant']['startnr']; ?>:
	<?= $contestant['Contestant']['name']; ?>
</h2>
<h2>
	<small>(<?= $contestant['Club']['name']; ?>)</small>
</h2>

<h3>
	<span class="nowrap"><?= $contestant['Discipline']['name']; ?>,</span>
	<span class="nowrap"><?= $contestant['Category']['name']; ?>,</span>
	<span class="nowrap"><?= $contestant['Division']['name']; ?></span>
</h3>
