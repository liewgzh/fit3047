<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 * @var \Cake\Collection\CollectionInterface|string[] $counsellors
 * @var \Cake\Collection\CollectionInterface|string[] $services
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="appointments form content">
            <?= $this->Form->create($appointment) ?>
            <fieldset>

                <legend><?= __('Add Appointment') ?></legend>
                <?php

                    echo $this->Form->control('guest_name', ['maxlength' => '30']);
                    echo $this->Form->control('guest_email', ['maxlength' => '30']);
                    echo $this->Form->control('counsellor_id', ['options' => $counsellors]);
                    echo $this->Form->control('service_id', ['options' => $services]);
                    echo $this->Form->control('appointment_date');
                    echo $this->Form->control('start_time', [
                         'type' => 'time',
                         'label' => 'Start Time (9:00 AM to 4:00 PM):',
                         'min' => '09:00',
                         'max' => '16:00',
                         'required' => true]);
                    echo $this->Form->control('note', ['maxlength' => '400']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
