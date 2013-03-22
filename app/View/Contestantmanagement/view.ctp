<div id="error"></div>

<div class="row">

	<div class="three columns">
		<ul class="nav-bar vertical">
			<?php foreach ($round['Contestant'] as $c): ?>
			<li class="<?= $c['id']==$contestant['Contestant']['id'] ? 'active' : ''; ?>">
				<?= $this->Html->link(
					h($c['startnr'] .': '. $c['name']),
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

					<?= $this->Js->link(
						'toon naam',
						array('controller'=>'results', 'action'=>'showcontestantname', $contestant['Contestant']['id'], $round['Round']['id']),
						array('title'=>'Toon naam van '.h($contestant['Contestant']['name'].' op scorebord'),
							   'class'=>'tiny secondary button')
					); ?>
					<?= $this->Js->link(
						'toon',
						array('controller'=>'results', 'action'=>'showcontestant', $contestant['Contestant']['id'], $round['Round']['id']),
						array('title'=>'Toon resultaten van '.h($contestant['Contestant']['name'].' op scorebord'),
							   'class'=>'tiny secondary button')
					); ?>
					<?= $this->Html->link(
						'print',
						array('controller'=>'results', 'action'=>'contestant_print', 'ext'=>'pdf',
								$contestant['Contestant']['id'], $round['Round']['id'],
								$contestant['Contestant']['startnr']." - ".$contestant['Contestant']['name']." - ".$contestant['Club']['name']),
						array('title'=>'Print resultaten van '.h($contestant['Contestant']['name']),
							   'class'=>'tiny secondary button',
							   'target'=>'_blank')
					); ?>
				</h2>

				<div id="autorefresh"> <div class="load"></div> </div>

				<div class="buttonbar row">
					<div class="three column"></div>
					<div class="six columns">
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
					<div class="three column"></div>
				</div>

			</div>
		</div>
	</div>

</div>

<script>
	$(document).ready(function(){ refresh(); setInterval(refresh, 1000); });
   function refresh(){
   	$.get("<?= Router::url(array('action'=>'viewcontent', $contestant['Contestant']['id'], $round['Round']['id'])) ?>")
		 .done(function(data){
		 		$("#autorefresh").html(data);
		 		$("#error").html("");
		 })
		 .fail(function(){
		 	$("#error").html('<div class="alert-box alert">Kan gegevens niet updaten</div>');
		 });
   }
</script>