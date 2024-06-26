<!DOCTYPE html>
<html lang="en">

<head>

    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?= $this->Html->meta('icon') ?>

    <title><?= $this->fetch('title') ?></title>

    <!-- Custom fonts for this template-->
    <?= $this->Html->css('/vendor/fontawesome-free/css/all.min.css') ?>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <?= $this->Html->css('sb-admin-2.min.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

    <?= $this->Html->script('/vendor/jquery/jquery.min.js') ?>

</head>

<?php
// Get the current controller and action
$currentController = $this->getRequest()->getParam('controller');
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- content block here -->
            <?php if ($currentController !== 'ContentBlocks'): ?>

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $this->Url->build('/') ?>">
                <div class="sidebar-brand-icon">
                    <?= $this->ContentBlock->image('logo', ['style' => 'max-width: 50px; max-height:38px']); ?>
                </div>

            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($currentController === 'Pages') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'home']) ?>">
                    <i class="fas fa-fw fa-house-user"></i>
                    <span>Homepage</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Services
            </div>

            <!-- Guest appointment -->
            <li class="nav-item <?= ($currentController === 'Appointments') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Appointments', 'action' => 'guestadd']) ?>">
                    <i class="fas fa-fw fa-check"></i>
                    <span>Book As Guest</span>
                </a>
            </li>

            <!-- Nav Item - Appointments Collapse Menu -->
            <li class="nav-item <?= ($currentController === 'Appointments') ? 'active' : '' ?>">

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-calendar-check"></i>
                    <span>Appointments</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Appointments</h6>
                        <a class="collapse-item" href="<?= $this->Url->build(['controller' => 'Appointments', 'action' => 'index']) ?>">View All Appointments</a>
                        <a class="collapse-item" href="<?= $this->Url->build(['controller' => 'Appointments', 'action' => 'add']) ?>">Add Appointment</a>
                        <?php
                        $currentUser = $this->request->getAttribute('identity');
                        if ($currentUser && $currentUser->role === 'Admin'):
                        ?>
                        <a class="collapse-item" href="<?= $this->Url->build(['controller' => 'Appointments', 'action' => 'archived']) ?>">Archived Appointments</a>
                        <?php endif; ?>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Seminars Collapse Menu -->
            <li class="nav-item <?= ($currentController === 'Seminars') ? 'active' : '' ?>">

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeminars"
                   aria-expanded="true" aria-controls="collapseSeminars">
                    <i class="fas fa-fw fa-video"></i>
                    <span>Seminars</span>
                </a>
                <div id="collapseSeminars" class="collapse" aria-labelledby="headingSeminars" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Seminars</h6>
                        <a class="collapse-item" href="<?= $this->Url->build(['controller' => 'Seminars', 'action' => 'index']) ?>">View All Seminars</a>
                        <?php
                        // Check if the logged-in user is an admin
                        $currentUser = $this->request->getAttribute('identity');
                        if ($currentUser && $currentUser->role === 'Admin'):
                        ?>
                        <a class="collapse-item" href="<?= $this->Url->build(['controller' => 'Seminars', 'action' => 'add']) ?>">Add New Seminar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Information & Management
            </div>

            <!-- Nav Item - Users Collapse Menu -->
            <li class="nav-item <?= ($currentController === 'Users') ? 'active' : '' ?>">

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage User</h6>

                        <?php if (!$this->request->getAttribute('identity')) : ?>
                        <a class="collapse-item" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">Login</a>
                            <?php endif; ?>

                            <?php
                        $identity = $this->request->getAttribute('identity');
                        if ($identity==null) {

                        ?><a class="collapse-item" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'useradd']) ?>">Register New Account</a>
                        <?php
                        }
                        ?>

                        <?php
                        $identity = $this->request->getAttribute('identity');
                        if ($identity) {
                        $userId = $identity->getIdentifier();
                        ?>
                        <a class="collapse-item" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'view', $userId]) ?>">View My Profile</a>
                        <a class="collapse-item" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'edit', $userId]) ?>">Edit My Profile</a>
                        <?php
                        }
                        ?>
                        <?php
                        // Check if the logged-in user is an admin
                        $currentUser = $this->request->getAttribute('identity');
                        if ($currentUser && $currentUser->role === 'Admin'):
                        ?>
                        <a class="collapse-item" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">View All Users</a>
                        <?php endif; ?>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Services -->
            <li class="nav-item <?= ($currentController === 'Services') ? 'active' : '' ?>">

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServices"
                    aria-expanded="true" aria-controls="collapseServices">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Services</span>
                </a>
                <div id="collapseServices" class="collapse" aria-labelledby="headingServices" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Services</h6>
                        <a class="collapse-item" href="<?= $this->Url->build(['controller' => 'Services', 'action' => 'index']) ?>">View All Services</a>
                        <?php
                        // Check if the logged-in user is an admin
                        $currentUser = $this->request->getAttribute('identity');
                        if ($currentUser && $currentUser->role === 'Admin'):
                        ?>
                        <a class="collapse-item" href="<?= $this->Url->build(['controller' => 'Services', 'action' => 'add']) ?>">Add New Service</a>
                        <?php endif; ?>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <?php if ($this->request->getAttribute('identity')) : ?>
            <?php
            $identity = $this->request->getAttribute('identity');
            if ($identity->role == 'Admin') :
            ?>
             <li class="nav-item">
                 <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfigure"
                     aria-expanded="true" aria-controls="collapseConfigure">
                     <i class="fas fa-fw fa-cog"></i>
                     <span>Configure</span>
                 </a>
                 <div id="collapseConfigure" class="collapse" aria-labelledby="headingConfigure" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                         <h6 class="collapse-header">Configure</h6>

                         <?= $this->Html->link('Content Blocks', ['plugin' => 'ContentBlocks', 'controller' => 'ContentBlocks', 'action' => 'index']) ?>
                     </div>
                 </div>
             </li>
             <?php endif; ?>
            <?php endif; ?>



            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        <!-- content block end here -->
        <?php endif; ?>

         <!-- content block here -->
         <?php if ($currentController == 'ContentBlocks'): ?>

         <!-- Nav Item - Dashboard -->
         <li class="nav-item active">
             <a class="nav-link" href="<?= $this->Url->build('/') ?>">
                 <i class="fas fa-fw fa-house-user"></i>
                 <span>Back to Homepage</span></a>
         </li>

         <!-- content block end here -->
         <?php endif; ?>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                    <!-- content block here -->
                    <?php if ($currentController !== 'ContentBlocks'): ?>

                    <?php
                    $user = $this->request->getAttribute('identity');
                    ?>
                    <?php if ($user): ?>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?=$this->Html->image('undraw_profile.svg', ['class' => 'img-profile rounded-circle']) ?>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    <?php endif; ?>

                    <!-- content block end here -->
                    <?php endif; ?>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <?= $this->ContentBlock->text('copyright-message'); ?>
                        <?= $this->ContentBlock->html('contact-us'); ?>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <?= $this->Html->script('/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>

    <!-- Core plugin JavaScript-->
    <?= $this->Html->script('/vendor/jquery-easing/jquery.easing.min.js') ?>

    <!-- Custom scripts for all pages-->
    <?= $this->Html->script('sb-admin-2.min') ?>

<?= $this->fetch('script') ?>
</body>

<script>
    // JavaScript to hide sidebar on mobile by default
    document.addEventListener("DOMContentLoaded", function() {
        if (window.innerWidth <= 768) {
            document.getElementById("accordionSidebar").classList.add("toggled");
        }
    });
</script>

</html>
