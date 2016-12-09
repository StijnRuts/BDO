<?php
  $logoClasses = array(
    0 => array(),
    1 => array('middle'),
    2 => array('left', 'right'),
    3 => array('left', 'middle', 'right'),
  );
  $logoClasses = $logoClasses[count($logos)];
?>
<?php if (!empty($logos)): ?>
  <table class="logos">
    <tr>
      <?php foreach ($logos as $k => $logo): ?>
        <td class="img-<?php echo $logoClasses[$k]; ?>">
          <div class="image"
               style="background-image:url(/images/scoreboard/<?php echo $logo['ScoreboardImage']['name']; ?>)">
          </div>
        </td>
      <?php endforeach; ?>
    </tr>
  </table>
<?php endif; ?>

<?php echo $this->fetch('content'); ?>
