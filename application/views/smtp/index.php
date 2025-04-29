<!-- Content Wrapper -->
<div class="content-wrapper">
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h4 class="fw-bold text-center mb-4">SMTP Credentials</h4>

                        <?php if ($credentials): ?>
                            <table class="table table-bordered">
                                <tr>
                                    <th>SMTP Host</th>
                                    <td><?= htmlspecialchars($credentials['smtp_host'] ?? 'Not Set') ?></td>
                                </tr>
                                <tr>
                                    <th>SMTP Port</th>
                                    <td><?= htmlspecialchars($credentials['smtp_port'] ?? 'Not Set') ?></td>
                                </tr>
                                <tr>
                                    <th>Email (Username)</th>
                                    <td><?= htmlspecialchars($credentials['smtp_email'] ?? 'Not Set') ?></td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                    <td>********</td>
                                </tr>
                            </table>

                            <a href="<?= base_url('smtp/edit') ?>" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        <?php else: ?>
                            <div class="alert alert-info">
                                No SMTP credentials found. Please set up your SMTP settings.
                            </div>
                            <a href="<?= base_url('smtp/edit') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add SMTP Settings
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content Wrapper -->