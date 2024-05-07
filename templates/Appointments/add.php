<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 * @var \Cake\Collection\CollectionInterface|string[] $counsellors
 * @var \Cake\Collection\CollectionInterface|string[] $services
 */
?>
<h1 class="h3 mb-2 text-gray-800">Add New Appointment</h1>
<div class="side-nav-item">
    <?= $this->Html->link(__('Check Unavailability'), ['action' => 'calendar'], ['class' => 'side-nav-item']) ?>
</div>
<?= $this->Form->create($appointment) ?>
 <?php
     echo $this->Form->control('client_id', ['options' => $clients, 'required' => true, 'empty' => true]);
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
  <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>
