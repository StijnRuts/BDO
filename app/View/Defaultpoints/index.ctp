<table>
	<thead>
		<tr>
			<th></th>
			<th>Naam</th>
			<th>Min</th>
			<th>Max</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php output_rows($defaultpoints, 0, $this); ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="5" class="tablebutton">
				<?= $this->Html->link('Beoordelingspunt toevoegen', array('action'=>'add'), array('class'=>'small secondary radius  button')); ?>
			</td>
		</tr>
	</tfoot>
</table>

<?php
function output_rows($list, $level, $t){
	foreach($list as $item){
		echo $t->element('defaultpoint_indexrow', array(
			'defaultpoint'=>$item,
			'level'=>$level,
		));
		if( count($item['children'])>0 ) output_rows($item['children'], $level+1, $t);
	}
}
?>