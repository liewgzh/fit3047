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
            <div class="side-nav-item">
                <?= $this->Html->link(__('Edit Appointment'), ['action' => 'edit', $appointment->id]) ?>
            </div>
            <div class="side-nav-item">
                <?= $this->Form->postLink(
                    __('Delete Appointment'),
                    ['action' => 'delete', $appointment->id],
                    [
                        'confirm' => __('Are you sure you want to delete this appointment scheduled for {0} at {1}?', $appointment->appointment_date, $appointment->start_time)
                    ]
                ) ?>
            </div>
            <div class="side-nav-item">
                <?= $this->Html->link(__('List Appointments'), ['action' => 'index']) ?>
            </div>
            <div class="side-nav-item">
                <?= $this->Html->link(__('New Appointment'), ['action' => 'add']) ?>
            </div>
        </div>
    </aside>
    <div class="column column-80">
        <div class="appointments view content">
            <!-- <h3><?= h($appointment->id) ?></h3> -->
            <table>
                <tr>
                    <th><?= __('Client') ?></th>
                    <td><?= $appointment->hasValue('client') ? $this->Html->link($appointment->client->first_name, ['controller' => 'Users', 'action' => 'view', $appointment->client->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Guest Name') ?></th>
                    <td><?= h($appointment->guest_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Guest Email') ?></th>
                    <td><?= h($appointment->guest_email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Counsellor') ?></th>
                    <td><?= $appointment->hasValue('counsellor') ? $this->Html->link($appointment->counsellor->first_name, ['controller' => 'Users', 'action' => 'viewcounsellor', $appointment->counsellor->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Service') ?></th>
                    <td><?= $appointment->hasValue('service') ? $this->Html->link($appointment->service->service_title, ['controller' => 'Services', 'action' => 'view', $appointment->service->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Appointment Status') ?></th>
                    <td><?= h($appointment->appointment_status) ?></td>
                </tr>
                 <tr>
                    <th><?= __('Payment Status') ?></th>
                    <td><?= h($appointment->payment_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($appointment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Appointment Date') ?></th>
                    <td><?= h($appointment->appointment_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Time') ?></th>
                    <td><?= h($appointment->start_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Time') ?></th>
                    <td><?= h($appointment->end_time) ?></td>
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
            <div class="text">
                <strong><?= __('Note') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($appointment->note)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
