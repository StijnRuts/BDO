<p style="text-align:center; font-size:1.5em;">
  <?php echo date('d-m-Y'); ?> &nbsp;
  <?php echo date('H:i'); ?>
</p>

<?php $grid_classes = array(
  0 => '',
  1 => 'one-up',
  2 => 'two-up',
  3 => 'three-up',
  4 => 'four-up',
); ?>

<div class="row logos">
  <div class="ten columns offset-by-one">
    <ul class="block-grid <?php echo $grid_classes[count($logos)] ?>">
      <?php foreach ($logos as $logo): ?>
      	<li><img src="/images/scoreboard/<?php echo $logo['ScoreboardImage']['name']; ?>" class="logo" /></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<?php echo $this->fetch('content'); ?>
