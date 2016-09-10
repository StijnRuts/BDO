<?php
  $logoClasses = array(
    0 => array(),
    1 => array('middle'),
    2 => array('left', 'right'),
    3 => array('left', 'middle', 'right'),
  );
  $logoClasses = $logoClasses[count($logos)];
?>
<div class="logos">
  <?php foreach ($logos as $k => $logo): ?>
    <img class="<?php echo $logoClasses[$k]; ?>"
  	   src="/images/scoreboard/<?php echo $logo['ScoreboardImage']['name']; ?>"/>
  <?php endforeach; ?>
</div>

<?php echo $this->fetch('content'); ?>
