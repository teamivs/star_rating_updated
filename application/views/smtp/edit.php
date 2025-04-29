<!-- Content Wrapper -->
<div class="content-wrapper">
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h4 class="fw-bold text-center mb-4"><?= $credentials ? 'Edit' : 'Add' ?> SMTP Settings</h4>

                        <?php if (validation_errors()): ?>
                            <div class="alert alert-danger">
                                <?= validation_errors() ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <?= form_open('smtp/edit') ?>
                        <div class="form-group mb-3">
                            <label for="smtp_host">SMTP Host</label>
                            <input type="text" class="form-control" id="smtp_host" name="smtp_host"
                                value="<?= set_value('smtp_host', $credentials['smtp_host'] ?? '') ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="smtp_port">SMTP Port</label>
                            <input type="number" class="form-control" id="smtp_port" name="smtp_port"
                                value="<?= set_value('smtp_port', $credentials['smtp_port'] ?? '') ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="smtp_email">Email (Username)</label>
                            <input type="email" class="form-control" id="smtp_email" name="smtp_email"
                                value="<?= set_value('smtp_email', $credentials['smtp_email'] ?? '') ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="smtp_password">Password</label>
                            <input type="password" class="form-control" id="smtp_password" name="smtp_password"
                                value="<?= set_value('smtp_password') ?>" <?= $credentials ? '' : 'required' ?>>
                            <?php if ($credentials): ?>
                                <small class="form-text text-muted">Leave blank to keep current password</small>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Settings
                        </button>
                        <a href="<?= base_url('smtp') ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content Wrapper -->