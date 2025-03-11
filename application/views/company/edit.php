<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }

        .container {
            width: 80%;
            margin-left: 20%;
        }

        .card {
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .company-logo {
            max-width: 150px;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php $this->load->view('components/sidebar'); ?>
    <?php $this->load->view('components/navbar'); ?>

    <div class="container mt-5">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <div class="card p-4">
            <h4 class="fw-bold text-center mb-4">Edit Company Profile</h4>
<form action="<?= base_url('index.php/company/edit') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name" class="form-control" required
                    value="<?= $company['company_name'] ?? '' ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Company Logo</label>
                <input type="file" name="company_logo" class="form-control">
                <?php if (!empty($company['company_logo'])): ?>
                    <img src="<?= base_url($company['company_logo']) ?>" alt="Company Logo" class="company-logo mt-2">
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Company URL</label>
                <input type="url" name="company_url" class="form-control" required
                    value="<?= $company['company_url'] ?? '' ?>">
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <?= form_close() ?>
                </form>
        </div>
    </div>
</body>

</html>