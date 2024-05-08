<?php
//var_dump($appointments->toArray()[0]);


$data = [];
foreach ($appointments as $appointment) {
    // Format the start time
    $start = $appointment->appointment_date->format('Y-m-d');
    $start .= 'T' . $appointment->start_time->format('H:i:s');

    // Format the end time
    $end = $appointment->appointment_date->format('Y-m-d');
    $end .= 'T' . $appointment->end_time->format('H:i:s');

    $counsellorName = $appointment->counsellor->first_name;

    $item = [
    'title' => $counsellorName,
    'start' => $start,
    'end' => $end
    ];
    $data[] = $item;
}
echo json_encode($data);

