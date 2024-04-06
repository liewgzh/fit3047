<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Counsellor $counsellor
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Counsellor'), ['action' => 'edit', $counsellor->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Counsellor'), ['action' => 'delete', $counsellor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $counsellor->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Counsellors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Counsellor'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="counsellors view content">
            <h3><?= h($counsellor->email) ?></h3>
            <table>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($counsellor->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($counsellor->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($counsellor->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gender') ?></th>
                    <td><?= h($counsellor->gender) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($counsellor->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($counsellor->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($counsellor->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($counsellor->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Appointments') ?></h4>
                <?php if (!empty($counsellor->appointments)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Client Id') ?></th>
                            <th><?= __('Counsellor Id') ?></th>
                            <th><?= __('Service Id') ?></th>
                            <th><?= __('Appoinment Date Time') ?></th>
                            <th><?= __('Duration') ?></th>
                            <th><?= __('Appoinment Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($counsellor->appointments as $appointment) : ?>
                        <tr>
                            <td><?= h($appointment->id) ?></td>
                            <td><?= h($appointment->client_id) ?></td>
                            <td><?= h($appointment->counsellor_id) ?></td>
                            <td><?= h($appointment->service_id) ?></td>
                            <td><?= h($appointment->appoinment_date_time) ?></td>
                            <td><?= h($appointment->duration) ?></td>
                            <td><?= h($appointment->appoinment_status) ?></td>
                            <td><?= h($appointment->created) ?></td>
                            <td><?= h($appointment->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Appointments', 'action' => 'view', $appointment->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Appointments', 'action' => 'edit', $appointment->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Appointments', 'action' => 'delete', $appointment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointment->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
