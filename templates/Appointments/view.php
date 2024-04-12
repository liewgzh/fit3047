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
                    <th><?= __('Guest Name') ?></th>
                    <td><?= h($appointment->guest_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Guest Email') ?></th>
                    <td><?= h($appointment->guest_email) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $appointment->hasValue('user') ? $this->Html->link($appointment->user->first_name, ['controller' => 'Users', 'action' => 'view', $appointment->user->id]) : '' ?></td>
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
                    <th><?= __('Client Id') ?></th>
                    <td><?= $appointment->client_id === null ? '' : $this->Number->format($appointment->client_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Appoinment Date') ?></th>
                    <td><?= h($appointment->appoinment_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Appoinment Time') ?></th>
                    <td><?= h($appointment->appoinment_time) ?></td>
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
