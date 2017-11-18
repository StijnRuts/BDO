<?php
$places = array();
$startnrs = array();

foreach ($contestants as $contestant) {
    $places[] = $contestant['scores']['total'];
    $startnrs[ $contestant['startnrorder'] ] = $contestant['startnr'];
}

$places = array_unique($places);
rsort($places);
$keys = array_map(
    function($a){ return $a+1; },
    array_keys($places)
);
$places = array_combine($places, $keys);

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
                array('controller'=>'results', 'action'=>'showplace', $round['Round']['id'], end($places)+1),
                array('title'=>"Toon geen enkel resultaat op het scorebord", 'class'=>'small secondary button nothingbutton')
            ); ?>
            <?php foreach (array_reverse($places) as $place): ?>
                <?php echo $this->Js->link(
                    $place,
                    array('controller'=>'results', 'action'=>'showplace', $round['Round']['id'], $place),
                    array('title'=>"Toon de resultaten vanaf plaats $place op het scorebord", 'class'=>'small secondary button')
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
