* @var string $appointmentDate the date and time of the appointment
 */
?>
<div class="content">
    <!-- START CENTERED WHITE CONTAINER -->
    <table role="presentation" class="main">
        <!-- START MAIN CONTENT AREA -->
        <tr>
            <td class="wrapper">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <h3>Appointment Confirmation</h3>
                            <p>Hi <?= h($clientName) ?>,</p>
                            <p>Thank you for scheduling an appointment with us.</p>
                            <p>Your appointment is confirmed for <strong><?= h($appointmentDate) ?></strong>.</p>
                            <p>If you have any questions or need to reschedule, please contact us.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- END MAIN CONTENT AREA -->
    </table>
    <!-- END CENTERED WHITE CONTAINER -->
    <!-- START FOOTER -->


