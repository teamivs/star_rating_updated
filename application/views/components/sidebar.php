<style>
    .sidebar {
        width: 250px;
        height: 100vh;
        background-color: white;
        padding-top: 20px;
        position: fixed;
        top: 0;
        left: 0;
        overflow-y: auto;
    }

    .sidebar .nav-link {
        color: #333;
        padding: 12px 15px;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
        font-weight: 300;
        font-size: 1rem;
    }

    .sidebar .nav-link:hover {
        background-color: #f0f5ff;
        color: #0d6efd;
    }

    .sidebar .nav-link.active {
        background-color: #0d6efd;
        color: white;
    }

    .sidebar .dashboard-header {
        padding: 10px 15px;
        font-size: 12px;
        color: white;
        display: flex;
        align-items: center;
    }

    .sidebar .dashboard-header span {
        margin-left: 10px;
    }
</style>

<?php
$segment2 = $this->uri->segment(2); // Controller
$segment3 = $this->uri->segment(3); // Method
?>

<div class="sidebar">
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="<?php echo base_url('index.php/reviews/dashboard'); ?>"
                class="nav-link <?php echo ($segment2 == 'reviews' && $segment3 == 'dashboard') ? 'active' : ''; ?>">
                <i class="bi bi-bar-chart me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('index.php/users'); ?>"
                class="nav-link <?php echo ($segment2 == 'users') ? 'active' : ''; ?>">
                <i class="bi bi-person-plus me-2"></i> Show User
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('index.php/company/profile'); ?>"
                class="nav-link <?php echo ($segment2 == 'company' && $segment3 == 'profile') ? 'active' : ''; ?>">
                <i class="bi bi-building me-2"></i> Company Profile
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('index.php/smtp/index'); ?>"
                class="nav-link <?php echo ($segment2 == 'smtp') ? 'active' : ''; ?>">
                <i class="bi bi-envelope me-2"></i> Email Credentials
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('index.php/reviews'); ?>"
                class="nav-link <?php echo ($segment2 == 'reviews' && $segment3 != 'dashboard') ? 'active' : ''; ?>">
                <i class="icon-grid menu-icon me-2"></i> Comments
            </a>
        </li>
        
    </ul>
</div>
