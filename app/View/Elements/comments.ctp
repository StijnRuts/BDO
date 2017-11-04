<?php $comments = array(
    ':)' => 'Presentatie',
    'SP' => 'Algemeen spanning',
    'KK' => 'Kromme knieen',
    'KAP' => 'Kapstokken',
    'Rel' => 'Relivé',
    'A/H' => 'Arm/Hoofd',
    '...' => 'Op maat dansen',
    'OA' => 'Onderlinge afstanden',
    'F' => 'Formaties',
    'FW' => 'Formatiewissels',
    'MO' => 'Muziekomzet',
    'TB' => 'Themaboog',
    '*' => 'Blunder',
    'VS' => 'Voeten sluiten',
); ?>

<h3>Opmerkingen</h3>

<div class="shortcuts">
  <?php
  foreach ($comments as $shortcut => $comment) {
    echo sprintf(
      '<span title="%s" class="has-tip tip-top">'.
        '<button class="secondary button shortcut" data-comment="%s">'.
          '%s'.
        '</button>'.
      '</span>',
      $comment, $comment, $shortcut
    );
  }
  ?>
</div>

<?php echo $this->Form->input('Comments', array(
  'type'=>'textarea',
  'label'=>false,
  'rows'=>12,
)); ?>

