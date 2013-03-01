<h2>
	<?= h($contestant['Contestant']['startnr']); ?>:
	<?= h($contestant['Contestant']['name']); ?>
	<small>(
		<?= h($contestant['Discipline']['name']); ?>,
		<?= h($contestant['Category']['name']); ?>,
		<?= h($contestant['Division']['name']); ?>
	)</small>
</h2>

<div class="row">
	<div class="ten columns centered">
		<?= $this->Form->create('Score'); ?>
			<fieldset>
				<legend>Beoordeling</legend>
				<table>
					<thead>
						<tr>
							<th></th>
							<th>Score</th>
							<th>Min</th>
							<th>Max</th>
						</tr>
					</thead>
					<tbody>
						<?php output_rows($scores['points'], 0, $current_user['id'], $scores['scores'], $this); ?>
					</tbody>
				</table>



				<?php	foreach($this->request->data['Score'] as $key => $value): ?>
					<div class="row">
				   	<?= $this->Form->input('Score.'.$key.'.id', array('type'=>'hidden')); ?>
				   	<div class="twelve columns"><?= $this->Form->input('Score.'.$key.'.score'); ?></div>
				   </div>
				<?php endforeach; ?>



			</fieldset>
			<div class="buttonbar row">
				<div class="three columns"></div>
				<div class="six columns"><?= $this->Form->submit('Opslaan', array('class'=>'radius button')); ?></div>
				<div class="three columns"></div>
			</div>
		<?= $this->Form->end(); ?>
	</div>
</div>

<?php
function output_rows($list, $level, $user_id, $scores, $t){
	foreach($list as $item){
		echo $t->element('judge_row', array(
			'point'=>$item,
			'level'=>$level,
			'user_id'=>$user_id,
			'scores'=>$scores
		));
		if( count($item['children'])>0 ) output_rows($item['children'], $level+1, $user_id, $scores, $t);
	}
}
?>

<?php debug($this->request->data) ?>