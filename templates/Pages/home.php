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
    $seminarsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Seminars');
    $seminars = $seminarsTable->find()->all();
    $this->set(compact('seminars'));
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
        <li><a href="#" data-content="counselor">Counsellors</a></li>
        <li><a href="#" data-content="about">About</a></li>
        <li><a href="#" data-content="seminar">Seminars</a></li>
        <li><a href="<?= $this->Url->build(['controller' => 'Appointments', 'action' => 'guestadd']) ?>" class="book-button">Guest Appointment Booking</a></li>
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
            <h2>

                <?= $this->ContentBlock->image('logo', ['style' => 'max-width: 150px; max-height:100px']); ?>
                </h2>
                <h2>
                <?= $this->ContentBlock->text('website-title'); ?>
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

                            echo $this->Html->image('usericon.png', ['alt' => 'Counselor image', 'class' => 'smaller-image']);
                            echo '<h3>' . h($counselor->first_name . ' ' . $counselor->last_name) . '</h3>';

                            echo '<p>' . h($counselor->bio) . '</p>';
                            // We can also make the 'Learn More' button a link to the detail page
                            echo $this->Html->link('Learn More', ['controller' => 'Users', 'action' => 'viewcounsellor', $counselor->id], ['class' => 'button']);
                            echo '</div>';
                        }
                        ?>
                    </div>
                </section>
            </div>
            <div id="about-content" class="content-section" style="display: none;">
                <p>
                    <?= $this->ContentBlock->html('home-content'); ?>
                  <!--
                    Client Calm Wellness Centre focuses on conducting counselling sessions with customers,
                    mostly those with chronic fatigue syndrome, locally, within Australia.
                    The intent is to keep up with the current business climate and move from pen and paper
                    to having an online system with a website attracting customers and educating the public.
                    -->
                </p>
            </div>
            <div id="seminar-content" class="content-section" style="display: block;"> <!-- Make this visible by default -->
                <section class="seminars">
                    <div class="row">
                        <?php
                        foreach ($seminars as $seminar) {
                            echo '<div class="column">';
                            echo '<div class="video-wrapper">';
                            echo '<video width="320" height="240" controls poster="' . h($seminar->thumbnail_path) . '">';
                            echo '<source src="' . h($seminar->video_path) . '" type="video/mp4">';
                            echo 'Your browser does not support the video tag.';
                            echo '</video>';
                            echo '</div>';
                            echo '<h3>' . h($seminar->title) . '</h3>';
                            echo '<p>' . h($seminar->description) . '</p>';
                            // Link to view seminar details
                            echo $this->Html->link('Watch Full Seminar', ['controller' => 'Seminars', 'action' => 'view', $seminar->id], ['class' => 'button']);
                            echo '</div>';
                        }
                        ?>
                    </div>
                </section>
            </div>
        </div>
    </main>
</body>
</html>

<script>

    document.addEventListener('DOMContentLoaded', (event) => {
        const navItems = document.querySelectorAll('.top-nav li');
        const defaultActiveContent = 'counselor'; // Set the default content to be active

        function clearActiveStates() {
            navItems.forEach(item => {
                item.classList.remove('active');
            });
        }

        function setActiveState(content) {
            clearActiveStates();
            const activeNavItem = document.querySelector(`.top-nav a[data-content="${content}"]`).parentElement;
            activeNavItem.classList.add('active');
        }

        // Set the default active state
        setActiveState(defaultActiveContent);

        navItems.forEach(item => {
            item.querySelector('a[data-content]').addEventListener('click', function(e) {
                e.preventDefault();
                const contentToShow = this.getAttribute('data-content');

                document.querySelectorAll('.content-section').forEach(section => {
                    section.style.display = 'none';
                });

                document.getElementById(contentToShow + '-content').style.display = 'block';
                setActiveState(contentToShow);
            });
        });
    });


</script>



