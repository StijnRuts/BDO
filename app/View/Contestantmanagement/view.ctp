<div id="error"></div>

<div class="row">

	<div class="three columns">
		<ul class="nav-bar vertical">
			<?php foreach ($round['Contestant'] as $c): ?>
			<li class="<?= $c['id']==$contestant['Contestant']['id'] ? 'active' : ''; ?>">
				<?= $this->Html->link(
					$c['startnr'] .': '. $c['name'],
					array('action'=>'view', $c['id'], $round['Round']['id'])
				); ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="nine columns">
		<div class="row">
			<div class="twelve columns">

				<h2>
					<?= h($contestant['Contestant']['startnr']); ?>:
					<?= h($contestant['Contestant']['name']); ?>
					<small>(
						<?= h($contestant['Discipline']['name']); ?>,
						<?= h($contestant['Category']['name']); ?>,
						<?= h($contestant['Division']['name']); ?>
					)</small>

					<span class="nowrap">
					<?= $this->Js->link(
						'toon naam',
						array(
							'controller' => 'results',
							'action' => 'showcontestantname',
							$contestant['Contestant']['id'],
							$round['Round']['id'],
						),
						array(
							'title' => 'Toon naam van '.h($contestant['Contestant']['name'].' op scorebord'),
							'class' => 'tiny secondary button',
						)
					); ?>
					<?= $this->Js->link(
						'toon',
						array(
							'controller' => 'results',
							'action' => 'showcontestant',
							$contestant['Contestant']['id'],
							$round['Round']['id'],
						),
						array(
							'title' => 'Toon resultaten van '.h($contestant['Contestant']['name'].' op scorebord'),
							'class' => 'tiny secondary button',
						)
					); ?>
					<?= $this->Html->link(
						'print [-]',
						array(
							'controller' => 'results',
							'action' => 'contestant_print',
							'ext' => 'pdf',
							$contestant['Contestant']['id'],
							$round['Round']['id'],
							0,
							str_replace('/', '-', $contestant['Contestant']['startnr']." - ".$contestant['Contestant']['name']." - ".$contestant['Club']['name']),
						),
						array(
							'title' => 'Print resultaten van '.h($contestant['Contestant']['name'].', zonder jurynamen'),
							'class' => 'tiny secondary button',
							'target' => '_blank',
						)
					); ?>
					<?= $this->Html->link(
						'print [+]',
						array(
							'controller' => 'results',
							'action' => 'contestant_print',
							'ext' => 'pdf',
							$contestant['Contestant']['id'],
							$round['Round']['id'],
							1,
							str_replace('/', '-', $contestant['Contestant']['startnr']." - ".$contestant['Contestant']['name']." - ".$contestant['Club']['name']),
						),
						array(
							'title' => 'Print resultaten van '.h($contestant['Contestant']['name'].', met jurynamen'),
							'class' => 'tiny secondary button',
							'target' => '_blank',
						)
					); ?>
					</span>
				</h2>

				<div class="row" id="adminform">
				<?= $this->Form->create('Adminscore'); ?>
					<?= $this->Form->input('id', array('type'=>'hidden')); ?>
					<?= $this->Form->input('verplichtelem', array('type'=>'text', 'label'=>'Verplichte elementen')); ?>
					<?= $this->Form->input('strafpunten', array('type'=>'text', 'label'=>'Strafpunten')); ?>
					<?= $this->Form->submit('Opslaan', array('class'=>'small radius button')); ?>
				<?= $this->Form->end(); ?>
				</div>

				<div id="autorefresh"> <div class="load"></div> </div>

				<div class="buttonbar row">

					<div class="four columns">
						<?= $this->Js->link('Wis alle geplande beoordelingen',
						array('controller'=>'admin', 'action'=>'clearstage'),
						array('class'=>'secondary radius button')); ?>
					</div>

					<div class="five columns">
						<div class="button split dropdown">
							<?= $this->Js->link(
								'Laat beoordelen door alle juryleden',
								array('action'=>'stage', $contestant['Contestant']['id'], $round['Round']['id']),
								array('onclick'=>'alert("Beoordeling gestart voor alle juryleden")')
							); ?>
							<span></span>
							<ul>
							<?php foreach($scores['users'] as $user): ?>
								<li>
									<?= $this->Js->link(
										'Laat beoordelen door '.h($user['username']),
										array('action'=>'stage', $contestant['Contestant']['id'], $round['Round']['id'], $user['id'])
									); ?>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
					</div>

					<div class="three columns">
						<div class="button secondary dropdown">
							Pas scores aan van
							<ul>
							<?php foreach($scores['users'] as $user): ?>
								<li>
									<?= $this->Html->link(
										h($user['username']),
										array('action'=>'editscores', $contestant['Contestant']['id'], $round['Round']['id'], $user['id'])
									); ?>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

</div>

<script>
	$(document).ready(refresh);
   function refresh(){
   	$.get("<?= Router::url(array('action'=>'viewcontent', $contestant['Contestant']['id'], $round['Round']['id'])) ?>")
		 .done(function(data){
		 		$("#autorefresh").html(data);
		 		$("#error").html("");
		 })
		 .fail(function(){
		 	$("#error").html('<div class="alert-box alert">Kan gegevens niet updaten</div>');
		 });
		setTimeout(refresh, 1000);
   }

	$(window).bind('beforeunload', function() {
		$("#error").hide();
	});
</script>