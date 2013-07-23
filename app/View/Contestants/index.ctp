<table class="tablesorter">
	<thead>
		<tr>
			<th>Startnr</th>
			<th>Naam</th>
			<th>Club</th>
			<th>Discipline</th>
			<th>Categorie</th>
			<th>Divisie</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contestants as $contestant): ?>
		<tr>
			<td class="startnr"><?= h($contestant['Contestant']['startnr']); ?></td>
			<td>
				<?= $this->Html->link(
					$contestant['Contestant']['name'],
					array('action'=>'edit', $contestant['Contestant']['id']),
					array('title'=>'Bewerk '.h($contestant['Contestant']['name']), 'class'=>"tablelink")
				); ?>
			</td>
			<td><?= h($contestant['Club']['name']); ?></td>
			<td><?= h($contestant['Discipline']['name']); ?></td>
			<td><?= h($contestant['Category']['name']); ?></td>
			<td><?= h($contestant['Division']['name']); ?></td>
			<td>
				<?= $this->Html->link(
					'<i class="f-icon-tools"></i>',
					array('action'=>'edit', $contestant['Contestant']['id']),
					array('escape'=>false, 'title'=>'Bewerk '.h($contestant['Contestant']['name']))
				); ?>
				<?= $this->Form->postLink(
					'<i class="f-icon-remove"></i>',
					array('action'=>'delete', $contestant['Contestant']['id']),
					array('escape'=>false, 'title'=>'Verwijder '.h($contestant['Contestant']['name'])),
					'Weet u zeker dat u '.h($contestant['Contestant']['name']).' wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="7" class="tablebutton">
				<?= $this->Html->link('Lid toevoegen', array('action'=>'add'), array('class'=>'small secondary radius  button')); ?>
			</td>
		</tr>
	</tfoot>
</table>

<script>
	$(document).ready(function(){
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
				0: {sorter: 'startnr'},
				6: {sorter: false}
			}
		});
	});
</script>
