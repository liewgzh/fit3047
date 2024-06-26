* @var string $appointmentDate the date and time of the appointment
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Appointment Confirmation</title>
<style>
  body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
  }
  .container {
    background-color: #ffffff;
    width: 100%;
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }
  .content {
    padding: 20px;
    text-align: center;
    color: #333;
  }
  .footer {
    background-color: #ddd;
    color: #555;
    padding: 10px;
    text-align: center;
    font-size: 12px;
  }
</style>
</head>
<body>
  <div class="container">
    <div class="content">
      <h3>Appointment Confirmation</h3>
      <p>Hi <?= h($clientName) ?>,</p>
      <p>Thank you for scheduling an appointment with us.</p>
      <p>Your appointment is confirmed for <strong><?= h($appointmentDate) ?></strong>.</p>

      <?php if (h($serviceName) == 'consultation'): ?>
        <p>Your appointment will be conducted via Zoom. Please use the following link to join the meeting: <a href="https://zoom.us/">Join Zoom Meeting</a></p>
      <?php endif; ?>
      
      <p>If you have any questions or need to reschedule, please contact us.</p>
    </div>
    <div class="footer">
      <p>This email is addressed to <?= h($clientName) ?>.</p>
      <p>Please discard this email if it is not meant for you.</p>
      
    </div>
  </div>
</body>
</html>