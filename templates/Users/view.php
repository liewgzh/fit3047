<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Change password'), ['action' => 'changePassword', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users view content">
            <h3><?= h($user->first_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($user->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($user->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($user->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gender') ?></th>
                    <td><?= h($user->gender) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone Number') ?></th>
                    <td><?= h($user->phone_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($user->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Of Birth') ?></th>
                    <td><?= h($user->date_of_birth) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Bio') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($user->bio)); ?>
                </blockquote>
            </div>
            <div class="related">
                
                <?php if ($user->role === 'Client'): ?>               
                <h4><?= __('Related Appointments') ?></h4>
                <div class="table-responsive">
                    <table>
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
                        <?php foreach ($user->client_appointments as $clientAppointment) : ?>
                        <tr>
                            <td><?= h($clientAppointment->id) ?></td>
                            <td><?= h($clientAppointment->client->name) ?></td>
                            <td><?= h($clientAppointment->guest_name) ?></td>
                            <td><?= h($clientAppointment->guest_email) ?></td>
                            <td><?= h($clientAppointment->counsellor_id) ?></td>
                            <td><?= h($clientAppointment->service_id) ?></td>
                            <td><?= h($clientAppointment->appointment_date) ?></td>
                            <td><?= h($clientAppointment->start_time) ?></td>
                            <td><?= h($clientAppointment->end_time) ?></td>
                            <td><?= h($clientAppointment->appointment_status) ?></td>
                            <td><?= h($clientAppointment->note) ?></td>
                            <td><?= h($clientAppointment->created) ?></td>
                            <td><?= h($clientAppointment->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Appointments', 'action' => 'view', $clientAppointment->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Appointments', 'action' => 'edit', $clientAppointment->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Appointments', 'action' => 'delete', $clientAppointment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientAppointment->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                
            <?php if ($user->role === 'Counsellor'): ?>   
                <h4><?= __('Related Appointments') ?></h4>
                <div class="table-responsive">
                    <table>
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
                        <?php foreach ($user->counsellor_appointments as $counsellorAppointment) : ?>
                        <tr>
                            <td><?= h($counsellorAppointment->id) ?></td>
                            <td><?= h($counsellorAppointment->client_id) ?></td>
                            <td><?= h($counsellorAppointment->guest_name) ?></td>
                            <td><?= h($counsellorAppointment->guest_email) ?></td>
                            <td><?= h($counsellorAppointment->counsellor_id) ?></td>
                            <td><?= h($counsellorAppointment->service_id) ?></td>
                            <td><?= h($counsellorAppointment->appointment_date) ?></td>
                            <td><?= h($counsellorAppointment->start_time) ?></td>
                            <td><?= h($counsellorAppointment->end_time) ?></td>
                            <td><?= h($counsellorAppointment->appointment_status) ?></td>
                            <td><?= h($counsellorAppointment->note) ?></td>
                            <td><?= h($counsellorAppointment->created) ?></td>
                            <td><?= h($counsellorAppointment->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Appointments', 'action' => 'view', $counsellorAppointment->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Appointments', 'action' => 'edit', $counsellorAppointment->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Appointments', 'action' => 'delete', $counsellorAppointment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $counsellorAppointment->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <?php endif; ?>
                </div>
             
            </div>
            
        </div>
    </div>
</div>
