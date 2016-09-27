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
          <td><?php echo h($c['startnr']); ?>: <?php echo h($c['name']); ?></td>
          <td class="score"><strong><?php echo h($c['score']==0 ? '-' : $c['score']); ?></strong></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>


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
