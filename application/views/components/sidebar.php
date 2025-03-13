<nav class="sidebar" id="sidebar">
    <ul class="nav flex-column">
        <li>
            <a href="<?php echo base_url('reviews/dashboard'); ?>"
                class="nav-link <?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
                <i class="bi bi-bar-chart me-2"></i>
                <span class="nav-label">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('users'); ?>"
                class="nav-link <?php echo ($this->uri->segment(1) == 'users') ? 'active' : ''; ?>">
                <i class="bi bi-person-plus me-2"></i>
                <span class="nav-label">Show User</span>
            </a>
        </li>
        <?php if ($this->session->userdata('type') == 1): ?>
            <li>
                <a href="<?php echo base_url('company/profile'); ?>"
                    class="nav-link <?php echo ($this->uri->segment(2) == 'profile') ? 'active' : ''; ?>">
                    <i class="bi bi-building me-2"></i>
                    <span class="nav-label">Company Profile</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('smtp/index'); ?>"
                    class="nav-link <?php echo ($this->uri->segment(1) == 'smtp') ? 'active' : ''; ?>">
                    <i class="bi bi-envelope me-2"></i>
                    <span class="nav-label">Email Credentials</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('reviews'); ?>"
                    class="nav-link <?php echo ($this->uri->segment(1) == 'reviews' && $this->uri->segment(2) != 'dashboard') ? 'active' : ''; ?>">
                    <i class="bi bi-chat-dots me-2"></i>
                    <span class="nav-label">Comments</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<button class="btn btn-primary sidebar-toggle" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

<style>
    .sidebar {
        height: 100vh;
        position: fixed;
        width: 200px;
        background-color: #fff;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        padding-top: 20px;
        transition: transform 0.3s ease-in-out;
        transform: translateX(0);
        z-index: 999;
    }

    .sidebar.collapsed {
        transform: translateX(-100%);
    }

    .sidebar .nav-link {
        color: #000;
        padding: 10px 20px;
        display: flex;
        align-items: center;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background-color: #007bff;
        color: #fff;
    }

    .sidebar .nav-link .nav-label {
        /* margin-left: 10px; */
    }

    .sidebar-toggle {
        display: none;
    }

    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .sidebar-toggle {
            display: block;
            position: fixed;
            top: 10px;
            z-index: 1000;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.querySelector('.sidebar-toggle');

        toggleButton.addEventListener('click', function () {
            sidebar.classList.toggle('show');
        });
    });
</script>