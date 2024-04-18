<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;



$counselors = []; // Initialize an empty array to hold counselor data

try {
    // Use the UsersTable to get the counselors
    $usersTable = TableRegistry::getTableLocator()->get('Users');
    // Retrieve only the users with the role of 'Counsellor'
    $counselors = $usersTable->find()
        ->where(['role' => 'Counsellor'])
        ->all(); // Execute the query and get all results
} catch (\Exception $e) {
    // Handle exception if there's a problem with the database connection
}


//$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        ConnectionManager::get($name)->getDriver()->connect();
        // No exception means success
        $connected = true;
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
        if ($name === 'debug_kit') {
            $error = 'Try adding your current <b>top level domain</b> to the
                <a href="https://book.cakephp.org/debugkit/5/en/index.html#configuration" target="_blank">DebugKit.safeTld</a>
            config and reload.';
            if (!in_array('sqlite', \PDO::getAvailableDrivers())) {
                $error .= '<br />You need to install the PHP extension <code>pdo_sqlite</code> so DebugKit can work properly.';
            }
        }
    }

    return compact('connected', 'error');
};


?>
<!DOCTYPE html>
<html>
<nav class="top-nav">
    <ul>
        <li><a href="#" data-content="counselor">Counsellor</a></li>
        <li><a href="#" data-content="about">About</a></li>
        <li><a href="#" data-content="seminar">Seminar</a></li>
        <li><a href="<?= $this->Url->build(['controller' => 'Appointments', 'action' => 'guestadd']) ?>" class="book-button">Guest Appointment Book</a></li>
    </ul>
</nav>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Calm Wellness Center
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- I commented the below out due to sidebar font size issues
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake', 'home']) ?>
    -->

    <?= $this->Html->css('styles.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <div class="container text-center">
<!--            <a href="https://cakephp.org/" target="_blank" rel="noopener">-->
<!--                <img alt="CakePHP" src="https://cakephp.org/v2/img/logos/CakePHP_Logo.svg" width="350" />-->
<!--            </a>-->
            <h2>
                Calm Wellness Center
            </h2>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <div id="counselor-content" class="content-section">
                <section class="counselors">
                    <div class="row">
                        <?php
                        foreach ($counselors as $counselor) {
                            $detailUrl = $this->Url->build(['controller' => 'Users', 'action' => 'view', $counselor->id]);
                            echo '<div class="column">';
                            // Start of link that wraps the image and the name
                            echo '<a href="' . h($detailUrl) . '" class="counselor-link">';
                            echo $this->Html->image('nice_to_meet_u.jpg', ['alt' => 'Counselor image', 'class' => 'smaller-image']);
                            echo '<h3>' . h($counselor->first_name . ' ' . $counselor->last_name) . '</h3>';
                            // End of link
                            echo '</a>';
                            echo '<p>' . h($counselor->bio) . '</p>';
                            // We can also make the 'Learn More' button a link to the detail page, but it's optional since the image and name are already links
                            echo $this->Html->link('Learn More', $detailUrl, ['class' => 'button']);
                            echo '</div>';
                        }
                        ?>
                    </div>
                </section>
            </div>
            <div id="about-content" class="content-section" style="display: none;">
                <p>
                    Client Calm Wellness Centre focuses on conducting counselling sessions with customers,
                    mostly those with chronic fatigue syndrome, locally, within Australia.
                    The intent is to keep up with the current business climate and move from pen and paper
                    to having an online system with a website attracting customers and educating the public.
                </p>
            </div>
            <div id="seminar-content" class="content-section" style="display: none;">
                <section class="seminars">
                    <div class="row">
                        <!-- Counselor 1 -->
                        <div class="column">
                            <?= $this->Html->image('cat.jpg', ['alt' => 'Seminar image', 'class' => 'smaller-image']) ?>
                            <h3>Seminar 1</h3>
                            <p>Short description or bio of the Seminar.</p>
                            <p>Learn More</p>
                        </div>
                    </div>
                </section>
            </div>


        </div>
    </main>


</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.top-nav a[data-content]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const contentToShow = this.getAttribute('data-content');
                // Hide all content sections
                document.querySelectorAll('.content-section').forEach(section => {
                    section.style.display = 'none';
                });
                // Show the selected content section
                document.getElementById(contentToShow + '-content').style.display = 'block';
            });
        });
    });
</script>

