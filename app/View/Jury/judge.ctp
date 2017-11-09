<style>
	@media only screen and (min-width: 768px) {
		#previousscores { position:absolute; bottom:0; right:0; margin-bottom:56px; }
	}
</style>

<div id="error"></div>

<?= $this->Form->create('Score'); ?>

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
		<div class="four columns"><?= $this->Form->submit('Verstuur', array('class'=>'radius button')); ?></div>
		<div class="four columns"></div>
	</div>
</div>

<div class="four columns">
  <?php echo $this->element('comments', array('title' => true)); ?>
</div>

<div class="four columns" id="previousscores">
	<h3>Eerdere beoordelingen</h3>
	<table>
		<tbody>
			<?php foreach($round['Contestant'] as $c): ?>
			<tr>
				<td><?= h($c['startnr']); ?>: <?= h($c['name']); ?></td>
				<td class="score"><strong><?= h($c['score']); ?></strong></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

</div>
</div>

<?= $this->Form->end(); ?>


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
		//focus previous input field on arrow up
		$(window).bind('keydown', function(e){
			if(e.keyCode==38){
				var focusable = $(":input").not(":disabled").not(":hidden");
				var index = focusable.index($(':focus'))
				$(focusable[index-1]).focus();
			}
		});
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
			});
			$("#Score"+totalfield+"Score").val(total);
			$("#Score"+totalfield+"Score").change();
		}

		for(var i in fields) fields[i] = "#Score"+fields[i]+"Score";
		fields = fields.join(",");
		$(fields).bind('change', calculate);
		calculate();
	}

	$(document).ready(checkStage);
	function checkStage(){
		$.get("<?= Router::url(array('action'=>'checkstaged', $contestant['Contestant']['id'], $round['Round']['id'])) ?>")
		 .done(function(staged){
			if(!staged) window.location.href = "<?= Router::url(array('action'=>'index')) ?>";
			$("#error").html('');
		 })
		 .fail(function(){
			$("#error").html('<div class="alert-box alert">Kan geen verbinding maken</div>');
		 });
		setTimeout(checkStage, 5000);
	}
	$(window).bind('beforeunload', function() {
		$("#error").hide();
	});
</script>
