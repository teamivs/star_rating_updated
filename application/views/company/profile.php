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
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                transition: all 0.3s ease-in-out;
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
                word-break: break-word;
            }

            .info-item a:hover {
                text-decoration: underline;
            }

            @media (max-width: 768px) {
                .content-wrapper {
                    margin-left: 0;
                    width: 100%;
                }

                .main-content {
                    padding: 20px;
                }

                .card {
                    padding: 20px;
                }
            }
        </style>
    </head>

    <body>
        <div class="container-scroller">

            <?php $this->load->view('components/navbar'); ?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">

                <?php $this->load->view('components/sidebar') ?>

                <div class="content-wrapper" id="contentWrapper">
                    <div class="main-content">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-10 col-lg-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="text-center">Company Profile</h4>
                                            <?php if ($company): ?>
                                                <div class="text-center mb-4">
                                                    <?php if (!empty($company['company_logo'])): ?>
                                                        <img src="<?= base_url($company['company_logo']) ?>" alt="Company Logo"
                                                            class="company-logo">
                                                    <?php else: ?>
                                                        <img src="https://via.placeholder.com/120" alt="No Logo"
                                                            class="company-logo">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="info-item">
                                                    <strong>Company Name:</strong>
                                                    <?= htmlspecialchars($company['company_name']) ?>
                                                </div>
                                                <div class="info-item">
                                                    <strong>Company URL:</strong> <a
                                                        href="<?= htmlspecialchars($company['company_url']) ?>"
                                                        target="_blank">
                                                        <?= htmlspecialchars($company['company_url']) ?></a>
                                                </div>
                                                <a
                                                    href="<?= base_url('reviews/form?name=' . urlencode($company['company_name']) . '&logo=' . urlencode(base_url($company['company_logo'])) . '&url=' . urlencode($company['company_url'])) ?>">Leave
                                                    a Review</a>

                                                <div class="text-end mt-4">
                                                    <a href="<?= base_url('company/edit') ?>"
                                                        class="btn btn-primary btn-custom btn-edit"><i
                                                            class="fas fa-edit"></i> Edit</a>
                                                </div>
                                            <?php else: ?>
                                                <p class="text-center">No company details found.</p>
                                                <div class="text-center mt-4">
                                                    <a href="<?= base_url('company/edit') ?>"
                                                        class="btn btn-custom btn-create"><i class="fas fa-plus"></i> Create
                                                        Profile</a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    const sidebar = document.getElementById('sidebar');
                    const contentWrapper = document.getElementById('contentWrapper');

                    function adjustContent() {
                        if (window.innerWidth <= 768) {
                            contentWrapper.style.marginLeft = '0';
                            contentWrapper.style.width = '100%';
                        } else {
                            contentWrapper.style.marginLeft = '250px';
                            contentWrapper.style.width = 'calc(100% - 250px)';
                        }
                    }

                    window.addEventListener('resize', adjustContent);
                    adjustContent();
                </script>
    </body>

</html>