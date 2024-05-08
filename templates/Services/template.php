
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Client Id') ?></th>
                    <th><?= __('Guest Name') ?></th>
                    <th><?= __('Guest Email') ?></th>
                    <th><?= __('Counsellor Id') ?></th>
                    <th><?= __('Service Id') ?></th>
                    <th><?= __('Appointment Date') ?></th>
                    <th><?= __('Start Time') ?></th>
                    <th><?= __('End Time') ?></th>
                    <th><?= __('Appointment Status') ?></th>
                    <th><?= __('Note') ?></th>
                    <th><?= __('Created') ?></th>
                    <th><?= __('Modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($service->appointments as $appointment) : ?>
                <tr>
                    <tr>
                        <td><?= h($appointment->id) ?></td>
                        <td><?= h($appointment->client_id) ?></td>
                        <td><?= h($appointment->guest_name) ?></td>
                        <td><?= h($appointment->guest_email) ?></td>
                        <td><?= h($appointment->counsellor_id) ?></td>
                        <td><?= h($appointment->service_id) ?></td>
                        <td><?= h($appointment->appointment_date) ?></td>
                        <td><?= h($appointment->start_time) ?></td>
                        <td><?= h($appointment->end_time) ?></td>
                        <td><?= h($appointment->appointment_status) ?></td>
                        <td><?= h($appointment->note) ?></td>
                        <td><?= h($appointment->created) ?></td>
                        <td><?= h($appointment->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Appointments', 'action' => 'view', $appointment->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Appointments', 'action' => 'edit', $appointment->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Appointments', 'action' => 'delete', $appointment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointment->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

