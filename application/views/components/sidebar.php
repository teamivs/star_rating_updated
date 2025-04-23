<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">Main Menu</li>
        <li class="nav-item">
            <a href="<?php echo base_url('reviews/dashboard'); ?>"
                class="nav-link <?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
                <i class="bi bi-bar-chart me-2"></i>
                <span class="nav-label">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('users/show_users'); ?>"
                class="nav-link <?php echo ($this->uri->segment(1) == 'users') ? 'active' : ''; ?>">
                <i class="bi bi-person-plus me-2"></i>
                <span class="nav-label">Show User</span>
            </a>
        </li>
        <?php if ($this->session->userdata('type') == 1): ?>
            <li class="nav-item">
                <a href="<?php echo base_url('company/profile'); ?>"
                    class="nav-link <?php echo ($this->uri->segment(2) == 'profile') ? 'active' : ''; ?>">
                    <i class="bi bi-building me-2"></i>
                    <span class="nav-label">Company Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('smtp/index'); ?>"
                    class="nav-link <?php echo ($this->uri->segment(1) == 'smtp') ? 'active' : ''; ?>">
                    <i class="bi bi-envelope me-2"></i>
                    <span class="nav-label">Email Credentials</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('reviews'); ?>"
                    class="nav-link <?php echo ($this->uri->segment(1) == 'reviews' && $this->uri->segment(2) != 'dashboard') ? 'active' : ''; ?>">
                    <i class="bi bi-chat-dots me-2"></i>
                    <span class="nav-label">Comments</span>
                </a>
            </li>
        <?php endif; ?>

        < </ul>
            </div>
            </li>

    </ul>
</nav>