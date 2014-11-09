<div id="infopage"></div>

<h2><?= str_replace("  "," &nbsp;",h($contest['Contest']['name'])); ?></h2>

<h3>
	<span class="nowrap"><?= $round['Discipline']['name']; ?>,</span>
	<span class="nowrap"><?= $round['Category']['name']; ?>,</span>
	<span class="nowrap"><?= $round['Division']['name']; ?></span>
</h3>
