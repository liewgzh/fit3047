<?php
/**
 * Appointment Confirmation HTML email template
 *
 * @var \App\View\AppView $this
 * @var string $clientName email recipient's first name
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
                            

                            <?php if (($zoomLink!=null)): ?>
                                <p>To join your online consultation, please use the following Zoom link:</p>
                                <p><a href="<?= h($zoomLink) ?>" target="_blank">Join Zoom Meeting</a></p>
                            <?php endif; ?>  
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
    <div class="footer">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td class="content-block">
                    <span class="apple-link">This email is addressed to <?= h($clientName) ?>.</span><br>
                    Please discard this email if it is not meant for you.
                    <br><br>
                    Copyright &copy; <?= date("Y"); ?>
                </td>
            </tr>
        </table>
    </div>
    <!-- END FOOTER -->
</div>