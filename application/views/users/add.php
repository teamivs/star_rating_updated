<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Add New User</h4>
            </div>
            <div class="card-body">
                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger">
                        <?= validation_errors() ?>
                    </div>
                <?php endif; ?>

                <?= form_open('users/add') ?>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name') ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username (Email)</label>
                    <input type="email" class="form-control" id="username" name="username"
                        value="<?= set_value('username') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="">Select Role</option>
                        <option value="admin" <?= set_select('role', 'admin') ?>>Admin</option>
                        <option value="super_admin" <?= set_select('role', 'super_admin') ?>>Super Admin</option>
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save User
                    </button>
                    <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>