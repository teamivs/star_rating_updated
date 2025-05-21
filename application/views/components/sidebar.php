<!-- Mobile Toggle Button -->
<button class="btn btn-primary d-lg-none position-fixed" style="top: 10px; left: 10px; z-index: 1030;" id="sidebarToggle">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"><?php echo $this->session->userdata('username') ? $this->session->userdata('username') : 'Admin'; ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="<?php echo site_url('reviews/dashboard'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'reviews' && $this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo site_url('reviews'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'reviews' && $this->uri->segment(2) == '') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-star"></i>
                    <p>Reviews</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo site_url('keywords'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'keywords') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-key"></i>
                    <p>Keywords</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo site_url('bot_reviews'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'bot_reviews') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-robot"></i>
                    <p>Bot Reviews</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo site_url('smtp'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'smtp') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>SMTP Settings</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo site_url('company'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'company') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-building"></i>
                    <p>Company Info</p>
                </a>
            </li>
            <?php if ($this->session->userdata('role') === 'super_admin'): ?>
                <li class="nav-item">
                    <a href="<?php echo site_url('users'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'users') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 250px;
        padding: 20px;
        background: #343a40;
        color: #fff;
        z-index: 1000;
        transition: transform 0.3s ease-in-out;
    }

    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .content-wrapper {
            margin-left: 0 !important;
            width: 100% !important;
        }
    }

    .user-panel {
        padding: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .user-panel .image img {
        width: 40px;
        height: 40px;
    }

    .nav-sidebar .nav-link {
        color: rgba(255, 255, 255, 0.8);
        padding: 10px 15px;
        margin: 5px 0;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .nav-sidebar .nav-link:hover,
    .nav-sidebar .nav-link.active {
        color: #fff;
        background: rgba(255, 255, 255, 0.1);
    }

    .nav-sidebar .nav-link i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    @media (max-width: 576px) {
        .sidebar {
            width: 100%;
        }

        .user-panel .image img {
            width: 35px;
            height: 35px;
        }

        .nav-sidebar .nav-link {
            padding: 8px 12px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth < 992 &&
                !sidebar.contains(event.target) &&
                !sidebarToggle.contains(event.target) &&
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });
    });
</script>