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
            <?= $this->Html->link(__('Edit Service'), ['action' => 'edit', $service->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Service'), ['action' => 'delete', $service->id], ['confirm' => __('Are you sure you want to delete # {0}?', $service->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Services'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Service'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
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
                <h4><?= __('Related Appointments') ?></h4>
                <?php if (!empty($service->appointments)) : ?>
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
                        <?php foreach ($service->appointments as $appointment) : ?>
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
