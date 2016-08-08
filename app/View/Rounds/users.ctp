<div class="row">

  <div class="three columns">
		<ul class="nav-bar vertical">
			<?php foreach ($rounds as $r): ?>
			<li class="<?php echo $r['Round']['id'] == $round['Round']['id'] ? 'active' : ''; ?>">
				<?php echo $this->Html->link(
					$r['Discipline']['name'].', '.$r['Category']['name'].', '.$r['Division']['name'],
					array('action'=>'users', $r['Round']['id'])
				); ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>

  <div class="nine columns">
    <div class="row">
      <div class="twelve columns">
        <h2>
          Jurysamenstelling voor<br>
          <?php echo h($round['Discipline']['name']); ?>
          <?php echo h($round['Category']['name']); ?>
          <?php echo h($round['Division']['name']); ?>
          <span class="nowrap">
            <?php echo $this->Js->link(
              'toon',
              array('controller'=>'results', 'action'=>'showroundusers', $round['Round']['id']),
              array(
                'title' => sprintf(
                  'Toon jurysamenstelling van %s op scorebord',
                  h($round['Discipline']['name']).' '.h($round['Category']['name']).' '.h($round['Division']['name'])
                ),
                'class'=>'tiny secondary button')
            ); ?>
          </span>
        </h2>

        <div class="row">
          <div class="ten columns centered">
            <?php echo $this->Form->create('Contest', array('autocomplete' => 'off')); ?>
              <fieldset>
                <legend>Jurysamenstelling bewerken</legend>
                <?php echo $this->Form->input('id'); ?>
                <div class="row" id="RoundUsers">

                  <div class="six columns">
                    <h3>Jurysamenstelling</h3>
                    <ul id="jury_selected" class="sortable">
                      <?php foreach ($round['User'] as $user): ?>
                        <li id="<?php echo $user['id']; ?>">
                          <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                          <strong><?php echo h($user['number']); ?></strong> -
                          <?php echo h($user['username']); ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                  <div class="six columns">
                    <h3>Beschikbare juryleden</h3>
                    <?php foreach ($users as $user): ?>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value="<?php echo $user['User']['id']; ?>"
                              <?php if(in_array($user['User']['id'], $selected)) { echo 'checked'; } ?>
                              data-label="
                                <span class=&quot;ui-icon ui-icon-arrowthick-2-n-s&quot;></span>
                                <strong><?php echo h($user['User']['number']); ?></strong> -
                                <?php echo h($user['User']['username']); ?>
                              "/>
                          <strong><?php echo h($user['User']['number']); ?></strong> -
                          <?php echo h($user['User']['username']); ?>
                        </label>
                      </div>
                    <?php endforeach; ?>
                  </div>

                  <?php echo $this->Form->hidden('Round.User', array(
                    'class' => 'sortable input',
                    'value' => json_encode($selected),
                  )); ?>

                </div>
              </fieldset>
              <div class="row">
                <div class="six columns">
                  <?php echo $this->Form->submit('Opslaan',
                    array('class'=>'radius button')
                  ); ?>
                </div>
                <div class="six columns">
                  <?php echo $this->Html->link('Anuleren',
                    array('action'=>'view', $round['Round']['contest_id']),
                    array('class'=>'radius secondary button')
                  ); ?>
                </div>
              </div>
            <?php echo $this->Form->end(); ?>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
