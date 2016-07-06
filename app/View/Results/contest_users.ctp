<h2>
  Jurysamenstelling
  <?php echo h($contest['Contest']['name']); ?>
</h2>

<table class="contest_users">
  <tbody>
	  <tr>
      <?php foreach($contest['User'] as $key => $user): ?>
			  <td>Jury <?php echo $key+1; ?></td>
      <?php endforeach; ?>
    </tr><tr>
      <?php foreach($contest['User'] as $user): ?>
			  <td>
          <?php if (!empty($user['image'])): ?>
            <img src="/images/users/<?php echo $user['image']; ?>"/>
          <?php endif; ?>
        </td>
      <?php endforeach; ?>
    </tr><tr>
      <?php foreach($contest['User'] as $user): ?>
			  <td><?php echo h($user['username']); ?></td>
      <?php endforeach; ?>
	  </tr>
	</tbody>
</table>
