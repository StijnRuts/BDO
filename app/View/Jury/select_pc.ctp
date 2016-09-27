<div class="row">
  <div class="ten columns centered">
    <?php echo $this->Form->create(null, array('class'=>'custom')); ?>
      <fieldset>
        <legend>Kies PC nummer</legend>
        <div class="row">
          <div class="twelve columns"><?php echo $this->Form->input('Session.pc_number', array(
            'type' => 'number',
            'min' => 1,
            'default' => 1,
            'label'=>'PC nummer',
          )); ?></div>
        </div>
      </fieldset>
      <div class="row">
        <div class="six columns"><?php echo $this->Form->submit('Selecteer', array('class'=>'radius button')); ?></div>
        <div class="six columns"><?php echo $this->Html->link('Anuleren', array('controller'=>'home'), array('class'=>'radius secondary button')); ?></div>
      </div>
    <?php echo $this->Form->end(); ?>
  </div>
</div>
