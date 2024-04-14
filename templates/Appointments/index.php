<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Appointment> $appointments
 */
 echo $this->Html->css('/vendor/datatables/dataTables.bootstrap4.min.css', ['block' => true]);
 echo $this->Html->script('/vendor/datatables/jquery.dataTables.min.js', ['block' => true]);
 echo $this->Html->script('/vendor/datatables/dataTables.bootstrap4.min.js', ['block' => true]);
?>
<div class="appointments index content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= __('Appointments') ?></h1>
        <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> New Appointment</a>
    </div>
    <?= $this->Html->link(__('New Appointment'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Appointments') ?></h3>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><?= h('id') ?></th>
                    <th><?= h('client_id') ?></th>
                    <th><?= h('guest_name') ?></th>
                    <th><?= h('guest_email') ?></th>
                    <th><?= h('counsellor_id') ?></th>
                    <th><?= h('service_id') ?></th>
                    <th><?= h('appointment_date') ?></th>
                    <th><?= h('start_time') ?></th>
                    <th><?= h('end_time') ?></th>
                    <th><?= h('appointment_status') ?></th>
                    <th><?= h('created') ?></th>
                    <th><?= h('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?= $this->Number->format($appointment->id) ?></td>
                    <td><?= $appointment->hasValue('client') ? $this->Html->link($appointment->client->first_name, ['controller' => 'Users', 'action' => 'view', $appointment->client->id]) : '' ?></td>
                    <td><?= h($appointment->guest_name) ?></td>
                    <td><?= h($appointment->guest_email) ?></td>
                    <td><?= $appointment->hasValue('counsellor') ? $this->Html->link($appointment->counsellor->first_name, ['controller' => 'Users', 'action' => 'view', $appointment->counsellor->id]) : '' ?></td>
                    <td><?= $appointment->hasValue('service') ? $this->Html->link($appointment->service->service_title, ['controller' => 'Services', 'action' => 'view', $appointment->service->id]) : '' ?></td>
                    <td><?= h($appointment->appointment_date) ?></td>
                    <td><?= h($appointment->start_time) ?></td>
                    <td><?= h($appointment->end_time) ?></td>
                    <td><?= h($appointment->appointment_status) ?></td>
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
    <script>
        $(document).ready(function() {
          $('#dataTable').DataTable();
        });
    </script>>
</div>
