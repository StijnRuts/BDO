<div id="error"></div>
<p id="clock" style="text-align:center; font-size:1.5em;"></p>
<div id="autorefresh"></div>

<script>
  $(document).ready(refresh);

  function refresh(){
    // set clock
    $('#clock').html(getClock());

    // set contents
    $.get("<?= Router::url(array('action'=>'results')) ?>")
      .done(function(data){
        $("#autorefresh").html(data);
        $("#error").html("");
      })
      .fail(function(){
        $("#error").html('<div class="alert-box alert">Kan scorebord niet updaten</div>');
      });

    setTimeout(refresh, 1000);
  }

  function getClock() {
    var date = new Date();
    var pad = function(num) { return ('00' + num).substr(-2); };
    var y = date.getFullYear();
    var m = pad(date.getMonth() + 1);
    var d = pad(date.getDate());
    var h = pad(date.getHours());
    var i = pad(date.getMinutes());
    return d+'/'+m+'/'+y+'&nbsp;'+h+':'+i;
  }

  $(window).bind('beforeunload', function() {
    $("#error").hide();
  });
</script>
