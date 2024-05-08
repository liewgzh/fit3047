<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 * @var string[]|\Cake\Collection\CollectionInterface $clients
 * @var string[]|\Cake\Collection\CollectionInterface $counsellors
 * @var string[]|\Cake\Collection\CollectionInterface $services
 */
?>
<h1 class="h3 mb-2 text-gray-800">Edit Appointment</h1>
<?= $this->Form->create($appointment) ?>
 <?php
     echo $this->Form->control('client_id', ['options' => $clients, 'required' => true, 'empty' => true]);
     echo $this->Form->control('guest_name');
     echo $this->Form->control('guest_email');
     echo $this->Form->control('counsellor_id', ['options' => $counsellors]);
     echo $this->Form->control('service_id', ['options' => $services]);
     echo $this->Form->control('appointment_date');
     echo $this->Form->control('start_time');
     echo $this->Form->control('end_time');
     echo $this->Form->control('appointment_status');
     // Check if the user is not a client or counsellor before rendering the payment_status field
     $userRole = $this->request->getAttribute('identity')->role;
     if ($userRole !== 'Client' && $userRole !== 'Counsellor') {
         echo $this->Form->control('payment_status');
     }
     echo $this->Form->control('note');
 ?>
  <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>
