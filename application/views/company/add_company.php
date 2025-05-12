<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Add Company</h2>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>
        <form action="<?php echo base_url('company/add'); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name"
                    placeholder="Company Name">
                <?= form_error('company_name') ?>
            </div>
            <div class="mb-3">
                <label for="company_url" class="form-label">Company URL</label>
                <input type="text" class="form-control" id="company_url" name="company_url" placeholder="Company URL">
                <?= form_error('company_url') ?>
            </div>
            <div class="mb-3">
                <label for="google_url" class="form-label">Google URL</label>
                <input type="text" class="form-control" id="google_url" name="google_url" placeholder="Google URL">
                <?= form_error('google_url') ?>
            </div>
            <div class="mb-3">
                <label for="company_location" class="form-label">Company Location</label>
                <input type="text" class="form-control" id="company_location" name="company_location"
                    placeholder="Company Location">
                <?= form_error('company_location') ?>
            </div>
            <div class="mb-3">
                <label for="company_logo" class="form-label">Company Logo</label>
                <input type="file" class="form-control" id="company_logo" name="company_logo">
                <?= form_error('company_logo') ?>
            </div>
            <button type="submit" class="btn btn-primary">Add Company</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>