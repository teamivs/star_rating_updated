<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Company Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f4f6f9;
            }

            .content-wrapper {
                margin-left: 250px;
                width: calc(100% - 250px);
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            .main-content {
                flex-grow: 1;
                padding: 40px;
            }

            .card {
                border-radius: 16px;
                padding: 40px;
                background: #fff;
                box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            }

            .company-logo {
                width: 120px;
                height: 120px;
                border-radius: 100%;
                object-fit: cover;
                margin-bottom: 20px;
                border: 2px solid #e0e0e0;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            .btn-custom {
                padding: 12px 24px;
                border-radius: 8px;
                font-weight: 500;
            }



            .btn-create {
                background-color: #007bff;
                color: #fff;
            }

            h4 {
                font-weight: 600;
                margin-bottom: 30px;
            }

            .info-item {
                margin-bottom: 20px;
                display: flex;
                align-items: center;
            }

            .info-item strong {
                width: 180px;
                color: #555;
            }

            .info-item a {
                color: #007bff;
                text-decoration: none;
            }

            .info-item a:hover {
                text-decoration: underline;
            }
        </style>
    </head>

    <body>
        <?php $this->load->view('components/sidebar'); ?>

        <div class="content-wrapper">
            <div class="main-content">
                <div class="container">
                    <div class="card">
                        <h4 class="text-center">Company Profile</h4>
                        <?php if ($company): ?>
                            <div class="text-center mb-4">
                                <?php if (!empty($company['company_logo'])): ?>
                                    <img src="<?= base_url($company['company_logo']) ?>" alt="Company Logo"
                                        class="company-logo">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/120" alt="No Logo" class="company-logo">
                                <?php endif; ?>
                            </div>
                            <div class="info-item">
                                <strong>Company Name:</strong> <?= htmlspecialchars($company['company_name']) ?>
                            </div>
                            <div class="info-item">
                                <strong>Company URL:</strong> <a href="<?= htmlspecialchars($company['company_url']) ?>"
                                    target="_blank">
                                    <?= htmlspecialchars($company['company_url']) ?></a>
                            </div>
                            <div class="text-end mt-4">
                                <a href="<?= base_url('index.php/company/edit') ?>" class="btn btn-primary btn-custom btn-edit"><i
                                        class="fas fa-edit"></i> Edit Profile</a>
                            </div>
                        <?php else: ?>
                            <p class="text-center">No company details found.</p>
                            <div class="text-center mt-4">
                                <a href="<?= base_url('index.php/company/edit') ?>" class="btn btn-custom btn-create"><i
                                        class="fas fa-plus"></i> Create Profile</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>