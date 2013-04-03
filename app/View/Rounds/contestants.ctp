<div class="row">

	<div class="three columns">
		<ul class="nav-bar vertical">
			<?php foreach ($rounds as $r): ?>
			<li class="<?= $r['Round']['id']==$round['Round']['id'] ? 'active' : ''; ?>">
				<?= $this->Html->link(
					$r['Discipline']['name'].', '.$r['Category']['name'].', '.$r['Division']['name'],
					array('action'=>'contestants', $r['Round']['id'])
				); ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="nine columns">
		<div class="row">
			<div class="twelve columns">

				<h3>Deelnemers voor: <?= $round['Discipline']['name']; ?>, <?= $round['Category']['name']; ?>, <?= $round['Division']['name']; ?></h3>
				<?= $this->Form->create('Round'); ?>
				<table class="tablesorter selectable">
					<thead>
						<tr>
							<th></th>
							<th>Startnr</th>
							<th>Naam</th>
							<th>Club</th>
							<th>Discipline</th>
							<th>Categorie</th>
							<th>Divisie</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($contestants as $contestant): ?>
						<tr class="<?= (
							$round['Discipline']['id'] == $contestant['Discipline']['id'] &&
							$round['Category']['id']   == $contestant['Category']['id'] &&
							$round['Division']['id']   == $contestant['Division']['id']
						) ? 'match' : 'nomatch' ?>">
							<td><?= $this->Form->checkbox('', array(
								'checked' => in_array($contestant['Contestant']['id'], $selected),
								'name' => 'Contestant['.$contestant['Contestant']['id'].']',
								'value' => $contestant['Contestant']['id'],
								'hiddenField' => false,
								'id' => null
							)); ?></td>
							<td class="startnr"><?= h($contestant['Contestant']['startnr']); ?></td>
							<td><?= h($contestant['Contestant']['name']); ?></td>
							<td><?= h($contestant['Club']['name']); ?></td>
							<td><?= h($contestant['Discipline']['name']); ?></td>
							<td><?= h($contestant['Category']['name']); ?></td>
							<td><?= h($contestant['Division']['name']); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot style="display:none">
						<tr>
							<td colspan="7" class="tablebutton">
								<?= $this->Html->link('', '#', array('class'=>'small secondary radius  button')); ?>
							</td>
						</tr>
					</tfoot>
				</table>
				<div class="row">
					<div class="six columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
					<div class="six columns"><?= $this->Html->link('Anuleren',
						array( 'action'=>'view', $round['Round']['contest_id']),
						array('class'=>'radius secondary button')
					); ?></div>
				</div>
				<?= $this->Form->end(); ?>

			</div>
		</div>
	</div>

</div>


<script>
$(document).ready(function(){
	//table sorting
	$.tablesorter.addParser({
		id: 'startnr',
		is: function(s){ return false; },
		format: function(s){
			var startnr = $.trim( s.toUpperCase() );
			var nrzeros = /^0*/.exec(startnr)[0].length;
			var number = parseInt( /^[0-9]*/.exec(startnr)[0] );
			var letter = /[A-Z]/.exec(startnr);
			letter = letter==null ? 99 : letter[0].charCodeAt(0);
			return -1000000*nrzeros + (nrzeros>0 ? -1 : 1)*(100*number + letter);
		},
		type: 'numeric'
	});
	$(".tablesorter").tablesorter({
		headers: {
			0: {sorter: false},
			1: {sorter: 'startnr'}
		}
	});

	//rows control checkboxes
	$('tbody tr').click(function(){
		var checkbox = $(this).find('input[type=checkbox]');
		checkbox.prop("checked", !checkbox.prop("checked"));
	});
	$('tbody tr input[type=checkbox]').click(function(event){ event.stopPropagation(); });

	//show more/less button
	var state = '';
	$('tfoot a').click(function(e){ e.preventDefault(); });
	if( $('.match').length > 0 ){
		showless();
		$('tfoot').show();
		$('tfoot a').click(function(e){ if(state=='more') showless(); else showmore(); e.preventDefault(); });
	}
	function showmore(){
		$('.nomatch').show();
		$('tfoot a').text('Minder weergeven').addClass('showless').removeClass('showmore');
		state = 'more';
	}
	function showless(){
		$('.nomatch:not(:has(:checked))').hide();
		$('tfoot a').text('Meer weergeven').addClass('showmore').removeClass('showless');
		state = 'less';
	}
});
</script>