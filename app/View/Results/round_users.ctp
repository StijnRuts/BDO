<h2>
  Jurysamenstelling<br>
  <?php echo h($round['Discipline']['name']); ?>
  <?php echo h($round['Category']['name']); ?>
  <?php echo h($round['Division']['name']); ?>
</h2>

<table class="contest_users">
  <tbody>
    <tr>
      <?php foreach($round['User'] as $key => $user): ?>
        <td>Jury <?php echo $key+1; ?></td>
      <?php endforeach; ?>
    </tr><tr>
      <?php foreach($round['User'] as $user): ?>
        <td>
          <?php if (!empty($user['image'])): ?>
            <div class="jury-image">
            	<div style="background-image:url(/images/users/<?php echo $user['image']; ?>)"></div>
            </span>
          <?php endif; ?>
        </td>
      <?php endforeach; ?>
    </tr><tr>
      <?php foreach($round['User'] as $user): ?>
        <td><?php echo h($user['username']); ?></td>
      <?php endforeach; ?>
    </tr>
  </tbody>
</table>
