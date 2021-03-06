<h3>Beoordeling van <?= h($user['User']['username']); ?> voor</h3>
<h2>
	<?= h($contestant['Contestant']['startnr']); ?>:
	<?= h($contestant['Contestant']['name']); ?>
	<small>(
		<?= h($contestant['Discipline']['name']); ?>,
		<?= h($contestant['Category']['name']); ?>,
		<?= h($contestant['Division']['name']); ?> )
	</small>
</h2>

<?= $this->Form->create('Score'); ?>
<div class="row">

	<div class="three columns" id="previousscores">
	  <table>
	    <tbody>
	      <?php foreach ($round['Contestant'] as $c): ?>
	        <tr>
	          <td><?php echo h($c['startnr']); ?>: <?php echo h($c['name']); ?></td>
	          <td class="score">
	            <?php if ($c['score'] == 0): ?>
	              <strong>-</strong>
	            <?php else: ?>
	              <a href="#" data-reveal-id="scoresModal-<?php echo $c['id'] ?>">
	                <strong><?php echo h($c['score']); ?></strong>
	              </a>
	            <?php endif; ?>
	          </td>
	        </tr>
	      <?php endforeach; ?>
	    </tbody>
	  </table>
	</div>

	<div class="five columns">
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

	</div>
  <div class="four columns">
    <?php echo $this->element('comments', array('title' => false)); ?>
  </div>
</div>

<div class="buttonbar row">
	<div class="four columns"></div>
	<div class="two columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
	<div class="two columns"><?= $this->Html->link('Anuleren',
		array('action'=>'view', $contestant['Contestant']['id'], $round['Round']['id']),
		array('class'=>'radius secondary button')
	); ?></div>
	<div class="four columns"></div>
</div>
<?= $this->Form->end(); ?>


<?php foreach ($round['Contestant'] as $c): ?>
  <div id="scoresModal-<?php echo $c['id'] ?>" class="reveal-modal">
    <h2>Beoordeling van</h2>
    <h3><?php echo h($c['startnr']); ?>: <?php echo h($c['name']); ?></h3>
    <a class="close-reveal-modal">&times;</a>

    <table>
      <thead>
      <tr>
        <th></th>
        <th>Score</th>
        <th>Max</th>
      </tr>
      </thead>
      <tbody>
        <?php output_modal_rows($scores['points'], 0, $c['scores'], $this); ?>
        <tr>
          <th class="important name">Totaal</th>
          <td class="important"><?php echo h($c['score']); ?></td>
          <td class="important subfield score"><?= h($scores['maxtotal']) ?></td>
        </tr>
      </tbody>
    </table>
  </div>
<?php endforeach; ?>


<?php
function output_rows($list, $level, $user_id, $scores, $t){
	foreach($list as $item){
		if($item['Point']['id'] > -1) echo $t->element('editscores_row', array(
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

function output_modal_rows($list, $level, $scores, $t) {
    foreach ($list as $item) {
        if ($item['Point']['id'] > -1) {
          echo $t->element('modal_row', array(
            'point' => $item,
            'level' => $level,
            'scores' => $scores,
          ));
        }
        if (count($item['children']) > 0) {
            output_modal_rows($item['children'], $level+1, $scores, $t);
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
				val = isNaN(val)||val=="" ? 0 : parseFloat(val);
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
