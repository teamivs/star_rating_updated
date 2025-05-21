<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
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
            margin: 0;
        }

        .card-body {
            padding: 1.25rem;
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

        .table-responsive {
            margin: 0;
            padding: 0;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            white-space: nowrap;
            min-width: 150px;
            padding: 1rem;
        }

        .table td {
            word-break: break-word;
            padding: 1rem;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .action-buttons .btn {
            min-width: 120px;
        }

        @media (max-width: 991.98px) {
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

            .company-logo {
                width: 100px;
                height: 100px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .card {
                padding: 15px;
            }

            .table th {
                min-width: 120px;
                padding: 0.75rem;
            }

            .table td {
                padding: 0.75rem;
            }

            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .action-buttons .btn {
                width: 100%;
                margin: 5px 0;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 10px;
            }

            .card {
                padding: 15px;
                border-radius: 12px;
            }

            .card-body {
                padding: 1rem;
            }

            .company-logo {
                width: 80px;
                height: 80px;
            }

            .table th,
            .table td {
                padding: 0.5rem;
                font-size: 14px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem;
            }

            .card-tools {
                margin-top: 10px;
                width: 100%;
            }

            .card-tools .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container-scroller">

        <!-- Navbar removed -->
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <div class="content-wrapper" id="contentWrapper">
                <div class="main-content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-10 col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Company Profile</h3>
                                        <div class="card-tools">
                                            <a href="<?= base_url('company/edit') ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Edit Profile
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php if ($this->session->flashdata('success')): ?>
                                            <div class="alert alert-success alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-hidden="true">&times;</button>
                                                <?php echo $this->session->flashdata('success'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($this->session->flashdata('error')): ?>
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-hidden="true">&times;</button>
                                                <?php echo $this->session->flashdata('error'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($company): ?>
                                            <?php if ($this->session->userdata('user_role') !== 'super_admin'): ?>
                                                <div class="text-center mb-4">
                                                    <?php if (!empty($company['company_logo'])): ?>
                                                        <img src="<?= base_url($company['company_logo']) ?>" alt="Company Logo"
                                                            class="company-logo">
                                                    <?php else: ?>
                                                        <img src="https://via.placeholder.com/120" alt="No Logo"
                                                            class="company-logo">
                                                    <?php endif; ?>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th>Company Name</th>
                                                                <td><?= htmlspecialchars($company['company_name']) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Company URL</th>
                                                                <td>
                                                                    <a href="<?= htmlspecialchars($company['company_url']) ?>"
                                                                        target="_blank">
                                                                        <?= htmlspecialchars($company['company_url']) ?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php if (!empty($company['company_location'])): ?>
                                                                <tr>
                                                                    <th>Location</th>
                                                                    <td><?= htmlspecialchars($company['company_location']) ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php endif; ?>

                                            <div class="action-buttons mt-4">
                                                <a href="<?= base_url($this->session->userdata('user_id') . '/1') ?>"
                                                    class="btn btn-primary">
                                                    <i class="fas fa-robot"></i> GPT Review
                                                </a>
                                                <a href="<?= base_url($this->session->userdata('user_id') . '/2') ?>"
                                                    class="btn btn-success">
                                                    <i class="fas fa-star"></i> Normal Review
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <div class="alert alert-info">
                                                No company details found. Please create your company profile.
                                            </div>
                                            <div class="text-center">
                                                <a href="<?= base_url('company/edit') ?>" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Create Profile
                                                </a>
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