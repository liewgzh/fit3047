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

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

?>
<!DOCTYPE html>
<html>
<nav class="top-nav">
    <ul>
        <li><a href="#" data-content="counselor">Counsellor</a></li>
        <li><a href="#" data-content="about">About</a></li>
        <li><a href="#" data-content="seminar">Seminar</a></li>
        <li><a href="<?= $this->Url->build(['controller' => 'Appointments', 'action' => 'add']) ?>" class="book-button">Book</a></li>
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

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake', 'home']) ?>

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
                        <!-- Counselor 1 -->
                        <div class="column">
                            <?= $this->Html->image('nice_to_meet_u.jpg', ['alt' => 'Counselor image']) ?>
                            <h3>Counselor 1</h3>
                            <p>Short description or bio of the counselor.</p>
                            <?= $this->Html->link('Learn More', '/counselor-profile', ['class' => 'button']) ?>
                        </div>
                        <div class="column">
                            <?= $this->Html->image('nice_to_meet_u.jpg', ['alt' => 'Counselor image']) ?>
                            <h3>Counselor 2</h3>
                            <p>Short description or bio of the counselor.</p>
                            <?= $this->Html->link('Learn More', '/counselor-profile', ['class' => 'button']) ?>
                        </div>
                        <div class="column">
                            <?= $this->Html->image('nice_to_meet_u.jpg', ['alt' => 'Counselor image']) ?>
                            <h3>Counselor 3</h3>
                            <p>Short description or bio of the counselor.</p>
                            <?= $this->Html->link('Learn More', '/counselor-profile', ['class' => 'button']) ?>
                        </div>
                        <div class="column">
                            <?= $this->Html->image('nice_to_meet_u.jpg', ['alt' => 'Counselor image']) ?>
                            <h3>Counselor 4</h3>
                            <p>Short description or bio of the counselor.</p>
                            <?= $this->Html->link('Learn More', '/counselor-profile', ['class' => 'button']) ?>
                        </div>
                        <div class="column">
                            <?= $this->Html->image('nice_to_meet_u.jpg', ['alt' => 'Counselor image']) ?>
                            <h3>Counselor 5</h3>
                            <p>Short description or bio of the counselor.</p>
                            <?= $this->Html->link('Learn More', '/counselor-profile', ['class' => 'button']) ?>
                        </div>
                        <div class="column">
                            <?= $this->Html->image('nice_to_meet_u.jpg', ['alt' => 'Counselor image']) ?>
                            <h3>Counselor 6</h3>
                            <p>Short description or bio of the counselor.</p>
                            <?= $this->Html->link('Learn More', '/counselor-profile', ['class' => 'button']) ?>
                        </div>
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
                            <?= $this->Html->image('cat.jpg', ['alt' => 'Seminar image']) ?>
                            <h3>Seminar 1</h3>
                            <p>Short description or bio of the Seminar.</p>
                            <?= $this->Html->link('Learn More', '/seminar', ['class' => 'button']) ?>
                        </div>
                        <div class="column">
                            <?= $this->Html->image('cat.jpg', ['alt' => 'Seminar image']) ?>
                            <h3>Seminar 2</h3>
                            <p>Short description or bio of the Seminar.</p>
                            <?= $this->Html->link('Learn More', '/seminar', ['class' => 'button']) ?>
                        </div>
                        <div class="column">
                            <?= $this->Html->image('cat.jpg', ['alt' => 'Seminar image']) ?>
                            <h3>Seminar 3</h3>
                            <p>Short description or bio of the Seminar.</p>
                            <?= $this->Html->link('Learn More', '/seminar', ['class' => 'button']) ?>
                        </div>
                        <div class="column">
                            <?= $this->Html->image('cat.jpg', ['alt' => 'Seminar image']) ?>
                            <h3>Seminar 4</h3>
                            <p>Short description or bio of the Seminar.</p>
                            <?= $this->Html->link('Learn More', '/seminar', ['class' => 'button']) ?>
                        </div>
                        <div class="column">
                            <?= $this->Html->image('cat.jpg', ['alt' => 'Seminar image']) ?>
                            <h3>Seminar 5</h3>
                            <p>Short description or bio of the Seminar.</p>
                            <?= $this->Html->link('Learn More', '/seminar', ['class' => 'button']) ?>
                        </div>
                        <div class="column">
                            <?= $this->Html->image('cat.jpg', ['alt' => 'Seminar image']) ?>
                            <h3>Seminar 6</h3>
                            <p>Short description or bio of the Seminar.</p>
                            <?= $this->Html->link('Learn More', '/seminar', ['class' => 'button']) ?>
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

