<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Service $service
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?php
            // Check if the logged-in user is an admin
            $currentUser = $this->request->getAttribute('identity');
            if ($currentUser && $currentUser->role === 'Admin'):
            ?>
            <?= $this->Html->link(__('Edit Service'), ['action' => 'edit', $service->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Service'), ['action' => 'delete', $service->id], ['confirm' => __('Are you sure you want to delete # {0}?', $service->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Service'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?php endif; ?>
            <?= $this->Html->link(__('List Services'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="services view content">
            <h3><?= h($service->service_title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Service Title') ?></th>
                    <td><?= h($service->service_title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($service->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Duration') ?></th>
                    <td><?= $this->Number->format($service->duration) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($service->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($service->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($service->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Service Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($service->service_description)); ?>
                </blockquote>
            </div>
            <div class="related">
                 <?php
                    // Check if the logged-in user is an admin
                    $currentUser = $this->request->getAttribute('identity');
                    if ($currentUser && $currentUser->role === 'Admin'):
                    ?>
                <?php if (!empty($service->appointments)) : ?>
                <h4><?= __('Related Appointments') ?></h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><?= __('Client ID') ?></th>
                                    <th><?= __('Counsellor ID') ?></th>
                                    <th><?= __('Appointment Date') ?></th>
                                    <th><?= __('Start Time') ?></th>
                                    <th><?= __('End Time') ?></th>
                                    <th><?= __('Appointment Status') ?></th>
                                    <th><?= __('Payment Status') ?></th>
                                    <th><?= __('Note') ?></th>
                                    <th><?= __('Guest Name') ?></th>
                                    <th><?= __('Guest Email') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($service->appointments as $appointment) : ?>
                                    <tr>
                                        <td><?= h($appointment->client_id) ?></td>
                                        <td><?= h($appointment->counsellor_id) ?></td>
                                        <td><?= h($appointment->appointment_date) ?></td>
                                        <td><?= h($appointment->start_time) ?></td>
                                        <td><?= h($appointment->end_time) ?></td>
                                        <td><?= h($appointment->appointment_status) ?></td>
                                        <td><?= h($appointment->payment_status) ?></td>
                                        <td><?= h($appointment->note) ?></td>
                                        <td><?= h($appointment->guest_name) ?></td>
                                        <td><?= h($appointment->guest_email) ?></td>
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
                <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
