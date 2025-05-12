<!-- Content Wrapper -->
<!--<div class="content-wrapper">
    <div class="main-content">-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h4 class="fw-bold text-center mb-4">Edit SMTP Credentials</h4>
                <div class="p-4">
                    <form action="" method="post">
                        <div class="form-group mb-3">
                            <label for="smtp_host" class="form-label">SMTP Host</label>
                            <input type="text" name="smtp_host" id="smtp_host"
                                value="<?= $credentials['smtp_host'] ?? '' ?>" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="smtp_port" class="form-label">SMTP Port</label>
                            <input type="text" name="smtp_port" id="smtp_port"
                                value="<?= $credentials['smtp_port'] ?? '' ?>" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="smtp_email" class="form-label">SMTP Email</label>
                            <input type="email" name="smtp_email" id="smtp_email"
                                value="<?= $credentials['smtp_email'] ?? '' ?>" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="smtp_password" class="form-label">SMTP Password</label>
                            <input type="password" name="smtp_password" id="smtp_password" class="form-control">
                            <small class="text-muted">Leave blank to keep current password</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="encryption" class="form-label">Encryption</label>
                            <select name="encryption" class="form-control" id="encryption" required>
                                <option value="tls" <?= (isset($smtp['encryption']) && $smtp['encryption'] == 'tls') ? 'selected' : ''; ?>>TLS</option>
                                <option value="ssl" <?= (isset($smtp['encryption']) && $smtp['encryption'] == 'ssl') ? 'selected' : ''; ?>>SSL</option>
                                <option value="none" <?= (isset($smtp['encryption']) && $smtp['encryption'] == 'none') ? 'selected' : ''; ?>>None</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                <?= $credentials ? 'Update' : 'Add' ?> Credentials
                            </button>
                            <a href="<?= base_url('smtp') ?>" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content Wrapper -->