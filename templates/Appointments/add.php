<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 *  @var \Cake\Collection\CollectionInterface|string[] $counsellors
 * @var \Cake\Collection\CollectionInterface|string[] $services
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Appointments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="appointments form content">
            <?= $this->Form->create($appointment) ?>
            <fieldset>
                <legend><?= __('Add Appointment') ?></legend>
                <?php
                    echo $this->Form->control('client_id', ['options' => $clients]);
                    echo $this->Form->control('guest_name');
                    echo $this->Form->control('guest_email');
                    echo $this->Form->control('counsellor_id', ['options' => $counsellors]);
                    echo $this->Form->control('service_id', ['options' => $services]);
                    echo $this->Form->control('appoinment_date');
                    echo $this->Form->control('appoinment_time');
                    echo $this->Form->control('end_time');
                    echo $this->Form->control('appoinment_status');
                    echo $this->Form->control('note');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
