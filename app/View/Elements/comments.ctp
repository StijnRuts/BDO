<?php $comments = array(
    ':)' => 'Presentatie',
    'SP' => 'Algemeen spanning',
    'KK' => 'Kromme knieen',
    'KAP' => 'Kapstokken',
    'Rel' => 'Relevé',
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

<?php if ($title): ?>
  <h3>Opmerkingen</h3>
<?php endif; ?>

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

<?php echo $this->Form->input('Comment.comment', array(
  'type'=>'textarea',
  'label'=>false,
  'rows'=>12,
)); ?>
<?php echo $this->Form->hidden('Comment.id'); ?>
