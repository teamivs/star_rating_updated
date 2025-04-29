<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
        }

        .main-container {
            margin-left: 20%;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .card {
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background: white;
        }

        .company-logo {
            max-width: 150px;
            height: auto;
            margin-top: 10px;
            border-radius: 8px;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
        }

        .btn-success {
            background: linear-gradient(45deg, #4361ee, #3f37c9);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-success:hover {
            background: linear-gradient(45deg, #3f37c9, #4361ee);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }

        @media (max-width: 768px) {
            .main-container {
                margin-left: 0;
                margin-top: 25px;
            }
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <div class="main-container">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <h4 class="fw-bold text-center mb-4">Edit Company Profile</h4>
                    <?= form_open_multipart('company/edit', ['class' => 'needs-validation']); ?>
                    <div class="mb-3">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="company_name" class="form-control" required
                            value="<?= $company['company_name'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company Logo</label>
                        <input type="file" name="company_logo" class="form-control" accept="image/*">
                        <?php if (!empty($company['company_logo'])): ?>
                            <img src="<?= base_url($company['company_logo']) ?>" alt="Company Logo"
                                class="company-logo mt-2">
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company URL</label>
                        <input type="url" name="company_url" class="form-control" required
                            value="<?= $company['company_url'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Google URL</label>
                        <input type="url" name="google_url" class="form-control" required
                            value="<?= $company['google_url'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company Location</label>
                        <input type="text" name="company_location" class="form-control"
                            value="<?= $company['company_location'] ?? '' ?>">
                        <small class="text-muted">Enter the city or area where your company is located</small>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>