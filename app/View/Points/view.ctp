<div class="row">

	<div class="three columns">
		<ul class="nav-bar vertical">
			<?php foreach ($contests as $c): ?>
			<li class="<?= $c['Contest']['id']==$contest['Contest']['id'] ? 'active' : ''; ?>">
				<?= $this->Html->link(
					$c['Contest']['name'],
					array('action'=>'view', $c['Contest']['id'])
				); ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="nine columns">
		<div class="row">
			<div class="twelve columns">

				<h2>Beoordelingspunten voor <?= h($contest['Contest']['name']); ?> <small>(<?= h($contest['Contest']['date']); ?>)</small></h2>
				<table>
					<thead>
						<tr>
							<th></th>
							<th>Naam</th>
							<th>Max</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php output_rows($points, 0, $this); ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5" class="tablebutton">
								<?= $this->Html->link('Beoordelingspunt toevoegen',
								array('action'=>'add', $contest['Contest']['id']),
								array('class'=>'small secondary radius  button')); ?>
							</td>
						</tr>
					</tfoot>
				</table>

				<?php
				function output_rows($list, $level, $t){
					foreach($list as $item){
						echo $t->element('point_indexrow', array(
							'point'=>$item,
							'level'=>$level,
						));
						if( count($item['children'])>0 ) output_rows($item['children'], $level+1, $t);
					}
				}
				?>

			</div>
		</div>
	</div>

</div>