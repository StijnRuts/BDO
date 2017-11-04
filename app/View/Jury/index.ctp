<div id="error"></div>
<h2>Wachten op deelnemer</h2>

<div class="load"></div>

<?php if(isset($round)): ?>
  <div>
    <h3>Eerdere beoordelingen</h3>
    <table>
      <tbody>
        <?php foreach($round['Contestant'] as $c): ?>
          <tr>
            <td><?= h($c['startnr']); ?>: <?= h($c['name']); ?></td>
            <td class="score">
                <?php if ($c['scores']['total'] == 0): ?>
                  <strong>-</strong>
                <?php else: ?>
                  <a href="" data-reveal-id="scoresModal-<?php echo $c['id'] ?>">
                    <?php $c['scores'][-1] = isset($c['scores'][-1]) ? $c['scores'][-1] : 0; ?>
                    <?php $score = $c['scores']['total'] - $c['scores'][-1]; ?>
                    <strong><?= h($score); ?></strong>
                  </a>
                <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php foreach($round['Contestant'] as $c): ?>
    <div id="scoresModal-<?php echo $c['id'] ?>" class="reveal-modal">
      <h2>Beoordeling van</h2>
      <h3><?= h($c['startnr']); ?>: <?= h($c['name']); ?></h3>
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
        <?php output_modal_rows($c['points'], 0, $c['scores'], $this); ?>
        <tr>
          <th class="important name">Totaal</th>
          <td class="important"><?= h($c['scores']['total']); ?></td>
          <td class="important subfield score"><?= h($c['maxtotal']) ?></td>
        </tr>
        </tbody>
      </table>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

<?php
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
?>

<script>
  $(document).ready(checkStage);
  function checkStage() {
    $.get("<?php echo Router::url(array('action' => 'checkstage')); ?>")
      .done(function(data) {
        data = JSON.parse(data);
        if (data.user_id != <?php echo intval($current_user['id']); ?>) {
          window.location.href = "<?php echo Router::url(array('action' => 'index')); ?>";
        }
        if (data.stage == true) {
          window.location.href = "<?php echo Router::url(array('action' => 'startjudging')); ?>";
        }
        $("#error").html('');
      })
      .fail(function() {
        $("#error").html('<div class="alert-box alert">Kan geen verbinding maken</div>');
      });
    setTimeout(checkStage, 5000);
  }
  $(window).bind('beforeunload', function() {
    $("#error").hide();
  });
</script>
