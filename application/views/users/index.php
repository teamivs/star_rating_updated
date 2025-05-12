<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /*        .content-wrapper {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
            width: calc(100% - 20%);
            transition: all 0.3s ease;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #eee;
            padding: 15px 20px;
        }

        .table-responsive {
            margin: 0;
            padding: 0;
        }

        .table {
            margin-bottom: 0;
        }
*/
        .role-badge {
            font-size: 0.8em;
            padding: 5px 10px;
            border-radius: 15px;
        }

        .role-admin {
            background-color: #0d6efd;
            color: white;
        }

        .role-super-admin {
            background-color: #dc3545;
            color: white;
        }

        .role-user {
            background-color: #6c757d;
            color: white;
        }

        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0;
                width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">User Management</h4>
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
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <!--<th>Role</th>-->
                                        <th>Password</th>
                                        <th>Created At</th>
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
                                                <td>
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
                                                            <i class="fas fa-sign-in-alt"></i> Login
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>