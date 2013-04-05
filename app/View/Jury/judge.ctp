<style>
	@media only screen and (min-width: 768px) {
		#previousscores { position:absolute; bottom:0; right:0; margin-bottom:56px; }
	}
</style>

<div class="row" style="position:relative;">
<div class="eight columns">

	<h2>
		<?= h($contestant['Contestant']['startnr']); ?>:
		<?= h($contestant['Contestant']['name']); ?>
	</h2>
	<h2>
		<small>(
			<?= h($contestant['Discipline']['name']); ?>,
			<?= h($contestant['Category']['name']); ?>,
			<?= h($contestant['Division']['name']); ?> )
		</small>
	</h2>

	<?= $this->Form->create('Score'); ?>
	<table>
		<thead>
			<tr>
				<th></th>
				<th>Score</th>
				<th>Max</th>
			</tr>
		</thead>
		<tbody>
			<?php output_rows($scores['points'], 0, $current_user['id'], $scores['scores'], $this); ?>
			<tr>
				<th class="important name">Totaal</th>
				<td class="important scoreinput">
					<?=  $this->Form->input('TotalScore', array(
						'type'=>'text',
						'size'=>4,
						'label'=>false,
						'disabled'=>"disabled"
					)); ?>
				</td>
				<?php $this->Js->buffer('
					dynamictotal(
						['.join(",",findindices($this->request->data, $scores['points'])).'],
						"Total"
					);
				'); ?>
				<td class="important subfield score"><?= h($scores['maxtotal']) ?></td>
			</tr>
		</tbody>
	</table>

	<div class="buttonbar row">
		<div class="four columns"></div>
		<div class="four columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
		<div class="four columns"></div>
	</div>
	<?= $this->Form->end(); ?>

</div>
<div class="four columns" id="previousscores">

	<h3>Eerdere beoordelingen</h3>
	<table>
		<tbody>
			<?php foreach($round['Contestant'] as $contestant): ?>
			<tr>
				<td><?= h($contestant['startnr']); ?>: <?= h($contestant['name']); ?></td>
				<td class="score"><strong><?= h($contestant['score']); ?></strong></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

</div>
</div>


<?php
function output_rows($list, $level, $user_id, $scores, $t){
	foreach($list as $item){
		if($item['Point']['id'] > -1) echo $t->element('judge_row', array(
			'point'=>$item,
			'level'=>$level,
			'user_id'=>$user_id,
			'scores'=>$scores,
			'form_id'=>findindex($t->request->data, $item['Point']['id']),
			'subcategory'=>count($item['children'])>0
		));
		if( count($item['children'])>0 ){
			$t->Js->buffer('
				dynamictotal(
					['.join(",",findindices($t->request->data, $item['children'])).'],
					'.findindex($t->request->data, $item['Point']['id']).'
				);
			');
			output_rows($item['children'], $level+1, $user_id, $scores, $t);
		}
	}
}

function findindex($requestdata, $point_id){
	foreach($requestdata['Score'] as $key=>$score){
		if($score['point_id']==$point_id) return $key;
	}
	return null;
}
function findindices($requestdata, $children){
	$result = array();
	foreach($children as $child){
		$result[] = findindex($requestdata, $child['Point']['id']);
	}
	return $result;
}
?>



<?= $this->Html->script('emulatetab'); ?>
<?= $this->Html->script('plusastab'); ?>
<script>
	$(function(){
		//make enter key (and arrow down) act as tab
		// -> move to next input field instead of submitting the form
		JoelPurra.PlusAsTab.setOptions({ key: [13, 40] });
	});
</script>

<script>
	function dynamictotal(fields, totalfield){
		function calculate(){
			var total = 0;
			$(fields).each(function(){
				var val = $.trim( $(this).val() );
				val = isNaN(val)||val=="" ? 0 : parseInt(val);
				total+=val;
				//if(totalfield=="Total") console.log("0"+$(this).val(), parseInt("0"+$(this).val()));
			});
			$("#Score"+totalfield+"Score").val(total);
			$("#Score"+totalfield+"Score").change();
		}

		for(var i in fields) fields[i] = "#Score"+fields[i]+"Score";
		fields = fields.join(",");
		$(fields).bind('change', calculate);
		calculate();
	}
</script>
