<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Appointment> $appointments
 */
 echo $this->Html->css('/vendor/datatables/dataTables.bootstrap4.min.css', ['block' => true]);
 echo $this->Html->script('/vendor/datatables/jquery.dataTables.min.js', ['block' => true]);
 echo $this->Html->script('/vendor/datatables/dataTables.bootstrap4.min.js', ['block' => true]);
?>
<div class="appointments archived content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= __('Archived Appointments') ?></h1>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><?= h('ID') ?></th>
                    <th><?= h('Date') ?></th>
                    <th><?= h('Start Time') ?></th>
                    <th><?= h('Deleted At') ?></th>
                    <th><?= h('Guest email') ?></th>
                    <th><?= h('Client id') ?></th>
                    <th><?= h('Counsellor id') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($archivedAppointments as $archivedAppointment): ?>
                <tr>
                    <td><?= $archivedAppointment->id ?></td>
                    <td><?= h($archivedAppointment->appointment_date) ?></td>
                    <td><?= h($archivedAppointment->start_time) ?></td>
                    <td><?= $archivedAppointment->deleted ? $archivedAppointment->deleted->format('Y-m-d H:i:s') : 'N/A' ?></td>
                    <td><?= h($archivedAppointment->guest_email) ?></td>
                     <td><?= $archivedAppointment->client_id ?></td>
                    <td><?= $archivedAppointment->counsellor_id ?></td>
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
