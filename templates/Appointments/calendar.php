<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Appointment> $appointments
 */
 echo $this->Html->script('https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js', ['block' => true]);
?>
<div class="appointments index content">
        <h1 class="h3 mb-0 text-gray-800"><?= __('Calendar') ?></h1>
        <div id='calendar'></div>
    </div>
    <script>
        $(document).ready(function() {
            const calendarEl = document.getElementById('calendar')
            const calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
              events: '<?= $this->Url->build(['controller' => 'Appointments', 'action' => 'calendar', '_ext' => 'json']) ?>'
            });
            calendar.render();
        });
    </script>>
</div>
