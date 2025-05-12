<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Star Rating System'; ?></title>

    <!-- jQuery (load first) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Custom CSS -->
    <style>
        .content-wrapper {
            background-color: #f4f6f9;
        }

        .card {
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
            margin-bottom: 1rem;
        }

        /* Remove navbar padding */
        body {
            padding-top: 0;
        }

        /* Consistent sidebar font styling */
        .nav-sidebar .nav-item .nav-link {
            font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.5;
            color: #c2c7d0;
        }

        .nav-sidebar .nav-item .nav-link:hover {
            color: #fff;
        }

        .nav-sidebar .nav-item .nav-link.active {
            color: #fff;
            font-weight: 600;
        }

        .nav-sidebar .nav-item .nav-link p {
            margin: 0;
            font-size: inherit;
            font-weight: inherit;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo site_url(); ?>" class="brand-link">
                <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Star Rating</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#"
                            class="d-block"><?php echo $this->session->userdata('username') ? $this->session->userdata('username') : 'Admin'; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="<?php echo site_url('reviews/dashboard'); ?>"
                                class="nav-link <?php echo ($this->uri->segment(1) == 'reviews' && $this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('reviews'); ?>"
                                class="nav-link <?php echo ($this->uri->segment(1) == 'reviews' && $this->uri->segment(2) == '') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-star"></i>
                                <p>Reviews</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('keywords'); ?>"
                                class="nav-link <?php echo ($this->uri->segment(1) == 'keywords') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-key"></i>
                                <p>Keywords</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?php echo site_url('bot_reviews'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'bot_reviews') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-robot"></i>
                                <p>Bot Reviews</p>
                            </a>
                        </li>-->
                        <li class="nav-item">
                            <a href="<?php echo site_url('smtp'); ?>"
                                class="nav-link <?php echo ($this->uri->segment(1) == 'smtp') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>SMTP Settings</p>
                            </a>
                        </li>
                        <?php if ($this->session->userdata('role') !== 'super_admin'): ?>
                            <li class="nav-item">
                                <a href="<?php echo site_url('company'); ?>"
                                    class="nav-link <?php echo ($this->uri->segment(1) == 'company') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>Company Info</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($this->session->userdata('role') === 'super_admin'): ?>
                            <li class="nav-item">
                                <a href="<?php echo site_url('users'); ?>"
                                    class="nav-link <?php echo ($this->uri->segment(1) == 'users') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="<?php echo site_url('reviews/logout'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?php echo isset($title) ? $title : 'Dashboard'; ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Home</a></li>
                                <?php if (isset($title)): ?>
                                    <li class="breadcrumb-item active"><?php echo $title; ?></li>
                                <?php endif; ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">