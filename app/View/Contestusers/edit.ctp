<div class="row">

  <div class="three columns">
    <ul class="nav-bar vertical">
      <?php foreach ($contests as $c): ?>
        <li class="<?php echo $c['Contest']['id']==$contest['Contest']['id'] ? 'active' : ''; ?>">
          <?php echo $this->Html->link(
            $c['Contest']['name'],
            array('action'=>'edit', $c['Contest']['id'])
          ); ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="nine columns">
    <div class="row">
      <div class="twelve columns">
        <h2>
          Jurysamenstelling voor <?php echo h($contest['Contest']['name']); ?>
          <small>(<?php echo h($contest['Contest']['date']); ?>)</small>
        </h2>

        <div class="row">
          <div class="ten columns centered">
            <?php echo $this->Form->create('Contest'); ?>
              <fieldset>
                <legend>Jurysamenstelling bewerken</legend>
                <?php echo $this->Form->input('id'); ?>
                <div class="row">

                  <div class="six columns">
                    <h3>Jurysamenstelling</h3>
                    <ul id="jury_selected" class="connectedSortable main">
                      <?php foreach ($contest['User'] as $user): ?>
                        <li id="<?php echo $user['id']; ?>">
                          <?php echo $user['username']; ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                  <div class="six columns">
                    <h3>Beschikbare juryleden</h3>
                    <ul id="jury_available" class="connectedSortable">
                      <?php foreach ($users as $user): ?>
                        <?php if (!in_array($user['User']['id'], $selected)): ?>
                          <li id="<?php echo $user['User']['id']; ?>">
                            <?php echo $user['User']['username']; ?>
                          </li>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </ul>
                  </div>

                  <?php echo $this->Form->hidden('Contest.User', array(
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
                    array('controller'=>'contests', 'action'=>'index'),
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
