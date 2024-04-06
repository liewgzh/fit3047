<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Counsellor> $counsellors
 */
?>
<div class="counsellors index content">
    <?= $this->Html->link(__('New Counsellor'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Counsellors') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('first_name') ?></th>
                    <th><?= $this->Paginator->sort('last_name') ?></th>
                    <th><?= $this->Paginator->sort('gender') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($counsellors as $counsellor): ?>
                <tr>
                    <td><?= $this->Number->format($counsellor->id) ?></td>
                    <td><?= h($counsellor->email) ?></td>
                    <td><?= h($counsellor->first_name) ?></td>
                    <td><?= h($counsellor->last_name) ?></td>
                    <td><?= h($counsellor->gender) ?></td>
                    <td><?= h($counsellor->created) ?></td>
                    <td><?= h($counsellor->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $counsellor->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $counsellor->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $counsellor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $counsellor->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
