<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Seminar> $seminars
 */
echo $this->Html->css('/vendor/datatables/dataTables.bootstrap4.min.css', ['block' => true]);
echo $this->Html->script('/vendor/datatables/jquery.dataTables.min.js', ['block' => true]);
echo $this->Html->script('/vendor/datatables/dataTables.bootstrap4.min.js', ['block' => true]);

?>
<div class="seminars index content">
    <?= $this->Html->link(__('New Seminar'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Seminars') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
            <tr>
                <th><?= __('ID') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Time') ?></th>
                <th><?= __('Video Path') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($seminars as $seminar): ?>
                <tr>
                    <td><?= $this->Number->format($seminar->id) ?></td>
                    <td><?= h($seminar->title) ?></td>
                    <td><?= h($seminar->date) ?></td>
                    <td><?= h($seminar->time) ?></td>
                    <td><?= h($seminar->video_path) ?></td>
                    <td><?= h($seminar->created) ?></td>
                    <td><?= h($seminar->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $seminar->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $seminar->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $seminar->id], ['confirm' => __('Are you sure you want to delete # {0}?', $seminar->id)]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
