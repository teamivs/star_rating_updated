    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class=" card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"></h4>
                            <?php if ($is_super_admin): ?>
                                <a href="<?= base_url('users/add') ?>" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add User
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= $this->session->flashdata('success') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= $this->session->flashdata('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <!--<th>Role</th>-->
                                            <th>Password</th>
                                            <th>Date</th>
                                            <?php if ($is_super_admin): ?>
                                                <th>Actions</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($user['name']) ?></td>
                                                <td><?= htmlspecialchars($user['username']) ?></td>
                                                <!--<td>
                                                <span class="role-badge role-<?= str_replace('_', '-', $user['role']) ?>">
                                                    <?= ucfirst(str_replace('_', ' ', $user['role'])) ?>
                                                </span>
                                            </td>-->
                                                <td><?= htmlspecialchars($user['password']) ?></td>
                                                <td><?= date('Y-m-d H:i', strtotime($user['timestam'])) ?></td>
                                                <?php if ($is_super_admin): ?>
                                                    <td style="text-align: center;">
                                                        <?php if ($user['role'] !== 'super_admin'): ?>
                                                            <a href="<?= base_url('users/edit/' . $user['id']) ?>"
                                                                class="btn btn-sm btn-primary">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="<?= base_url('users/delete/' . $user['id']) ?>"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <a href="<?= base_url('users/impersonate/' . $user['id']) ?>"
                                                                class="btn btn-sm btn-warning"
                                                                onclick="return confirm('Login as this user?')">
                                                                <i class="fas fa-sign-in-alt"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>