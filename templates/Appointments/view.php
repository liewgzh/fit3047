<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Appointment'), ['action' => 'edit', $appointment->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Appointment'), ['action' => 'delete', $appointment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointment->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Appointments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Appointment'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="appointments view content">
            <h3><?= h($appointment->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Client') ?></th>
                    <td><?= $appointment->hasValue('client') ? $this->Html->link($appointment->client->email, ['controller' => 'Clients', 'action' => 'view', $appointment->client->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Counsellor') ?></th>
                    <td><?= $appointment->hasValue('counsellor') ? $this->Html->link($appointment->counsellor->email, ['controller' => 'Counsellors', 'action' => 'view', $appointment->counsellor->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Service') ?></th>
                    <td><?= $appointment->hasValue('service') ? $this->Html->link($appointment->service->service_title, ['controller' => 'Services', 'action' => 'view', $appointment->service->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Appoinment Status') ?></th>
                    <td><?= h($appointment->appoinment_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($appointment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Duration') ?></th>
                    <td><?= $this->Number->format($appointment->duration) ?></td>
                </tr>
                <tr>
                    <th><?= __('Appoinment Date Time') ?></th>
                    <td><?= h($appointment->appoinment_date_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($appointment->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($appointment->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
