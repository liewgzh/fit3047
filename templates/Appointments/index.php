<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Appointment> $appointments
 */
?>
<div class="appointments index content">
    <?= $this->Html->link(__('New Appointment'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Appointments') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('client_id') ?></th>
                    <th><?= $this->Paginator->sort('counsellor_id') ?></th>
                    <th><?= $this->Paginator->sort('service_id') ?></th>
                    <th><?= $this->Paginator->sort('appoinment_date_time') ?></th>
                    <th><?= $this->Paginator->sort('duration') ?></th>
                    <th><?= $this->Paginator->sort('appoinment_status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?= $this->Number->format($appointment->id) ?></td>
                    <td><?= $appointment->hasValue('client') ? $this->Html->link($appointment->client->email, ['controller' => 'Clients', 'action' => 'view', $appointment->client->id]) : '' ?></td>
                    <td><?= $appointment->hasValue('counsellor') ? $this->Html->link($appointment->counsellor->email, ['controller' => 'Counsellors', 'action' => 'view', $appointment->counsellor->id]) : '' ?></td>
                    <td><?= $appointment->hasValue('service') ? $this->Html->link($appointment->service->service_title, ['controller' => 'Services', 'action' => 'view', $appointment->service->id]) : '' ?></td>
                    <td><?= h($appointment->appoinment_date_time) ?></td>
                    <td><?= $this->Number->format($appointment->duration) ?></td>
                    <td><?= h($appointment->appoinment_status) ?></td>
                    <td><?= h($appointment->created) ?></td>
                    <td><?= h($appointment->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $appointment->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $appointment->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $appointment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointment->id)]) ?>
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
