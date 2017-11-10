<tr class="level<?= $level; ?>">
    <th class="name"><?= h($point['Point']['name']); ?></th>
    <td><?= h($scores[$point['Point']['id']]); ?></td>
    <td class="subfield score"><?= h($point['Point']['max']); ?></td>
</tr>