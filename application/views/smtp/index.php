<!-- Content Wrapper -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SMTP Settings</h3>
                    <div class="card-tools">
                        <a href="<?= base_url('smtp/edit') ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit Settings
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($credentials): ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Setting</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SMTP Host</td>
                                    <td><?= htmlspecialchars($credentials['smtp_host'] ?? 'Not Set') ?></td>
                                </tr>
                                <tr>
                                    <td>SMTP Port</td>
                                    <td><?= htmlspecialchars($credentials['smtp_port'] ?? 'Not Set') ?></td>
                                </tr>
                                <tr>
                                    <td>Email (Username)</td>
                                    <td><?= htmlspecialchars($credentials['smtp_email'] ?? 'Not Set') ?></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>********</td>
                                </tr>
                                <tr>
                                    <td>Encryption</td>
                                    <td><?= htmlspecialchars($credentials['encryption'] ?? 'Not Set') ?></td>
                                </tr>
                            </tbody>
                        </table>
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
<!-- End Content Wrapper -->