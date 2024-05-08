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
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
	<?= $this->Html->charset() ?>
		<title><?= $this->fetch('title') ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="webroot/frontend/assets/css/main.css" />

		<?= $this->Html->meta('icon') ?>
		<?= $this->Html->css('styles.css') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<strong><?= $this->ContentBlock->image('logo', ['style' => 'max-width: 150px; max-height:100px']); ?></strong>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1><?= $this->ContentBlock->text('website-title'); ?><br />
											</h1>
											<p>About Us</p>
										</header>
										<p><?= $this->ContentBlock->html('home-content'); ?></p>
										<ul class="actions">
											<li><a href="<?= $this->Url->build(['controller' => 'Appointments', 'action' => 'guestadd']) ?>" class="button big">Book appointment as guest</a></li>
										</ul>
									</div>
									<span class="image object">
										<img src="webroot/frontend/images/pic10.jpg" alt="" />
									</span>
								</section>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Meet our counsellors</h2>
									</header>
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

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Watch our seminars</h2>
									</header>
									<div class="posts">
									    <article>
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
                                        </article>
                                    </div>
								</section>
						</div>
					</div>
			</div>

		<!-- Scripts -->
			<?= $this->Html->script('/frontend/assets/js/jquery.min.js') ?>
			<?= $this->Html->script('/frontend/assets/js/browser.min.js') ?>
			<?= $this->Html->script('/frontend/assets/js/breakpoints.min.js') ?>
			<?= $this->Html->script('/frontend/assets/js/util.js') ?>
			<?= $this->Html->script('/frontend/assets/js/main.js') ?>

	</body>
</html>




