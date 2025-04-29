<!-- Sidebar -->
            <div class="sidebar">
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