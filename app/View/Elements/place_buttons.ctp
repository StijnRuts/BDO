<?php
$ranks = array();
$startnrs = array();

foreach ($contestants as $contestant) {
    $ranks[] = $contestant['scores']['rank'];
    $startnrs[ $contestant['startnrorder'] ] = $contestant['startnr'];
}

$ranks = array_unique($ranks);
sort($ranks);
ksort($startnrs);
?>

<div style="text-align:center; margin-bottom:50px;">
    <div style="display:inline-block; text-align:left">
        <div id="placebuttons">
            <span style="display: inline-block; width:8em;">
                Toon op plaats:
            </span>
            <?php echo $this->Js->link(
                "leeg",
                array('controller'=>'results', 'action'=>'showplace', $round['Round']['id'], end($ranks)+1),
                array('title'=>"Toon geen enkel resultaat op het scorebord", 'class'=>'small secondary button nothingbutton')
            ); ?>
            <?php foreach (array_reverse($ranks) as $rank): ?>
                <?php echo $this->Js->link(
                    $rank,
                    array('controller'=>'results', 'action'=>'showplace', $round['Round']['id'], $rank),
                    array('title'=>"Toon de resultaten vanaf plaats $rank op het scorebord", 'class'=>'small secondary button')
                ); ?>
            <?php endforeach; ?>
        </div>
        <br/>
        <div id="startnrbuttons">
            <span style="display: inline-block; width:8em;">
                Toon op startnr:
            </span>
            <?php echo $this->Js->link(
                "leeg",
                array('controller'=>'results', 'action'=>'showstartnr', $round['Round']['id'], array_shift(array_keys($startnrs))-1),
                array('title'=>"Toon geen enkel resultaat op het scorebord", 'class'=>'small secondary button nothingbutton')
            ); ?>
            <?php foreach ($startnrs as $order=>$startnr): ?>
                <?php echo $this->Js->link(
                    $startnr,
                    array('controller'=>'results', 'action'=>'showstartnr', $round['Round']['id'], $order),
                    array('title'=>"Toon de resultaten tot startnr $startnr op het scorebord", 'class'=>'small secondary button')
                ); ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(function(){
    $("#placebuttons a, #startnrbuttons a").click(function() {
      $("#placebuttons a, #startnrbuttons a").addClass("secondary");
      $(this).removeClass("secondary");
      $(this).prevAll().removeClass("secondary");
      $(".nothingbutton").addClass("secondary");
    });
  });
</script>
