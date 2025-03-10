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

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: rgb(240, 242, 245);
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
            padding: 20px;
        }

        .card {
            border-radius: 10px;
            background: white;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .company-logo {
            max-width: 150px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php $this->load->view('components/sidebar'); ?>
    <!-- <?php $this->load->view('components/navbar'); ?> -->

    <div class="content-wrapper">
        <div class="main-content">
            <div class="container mt-5">
                <h4 class="fw-bold text-center mb-4">Company Profile</h4>
                <div class="card p-4">
                    <?php if ($company): ?>
                        <div class="text-center">
                            <?php if (!empty($company['company_logo'])): ?>
                                <img src="<?= base_url($company['company_logo']) ?>" alt="Company Logo" class="company-logo">
                            <?php endif; ?>
                        </div>
                        <p><strong>Company Name:</strong> <?= htmlspecialchars($company['company_name']) ?></p>
                        <p><strong>Company URL:</strong> <a href="<?= htmlspecialchars($company['company_url']) ?>"
                                target="_blank">
                                <?= htmlspecialchars($company['company_url']) ?></a></p>
                        <a href="<?= base_url('index.php/company/edit') ?>" class="btn btn-warning"><i
                                class="fas fa-edit"></i> Edit
                            Profile</a>
                    <?php else: ?>
                        <p>No company details found.</p>
                        <a href="<?= base_url('index.php/company/edit') ?>" class="btn btn-primary"><i
                                class="fas fa-plus"></i> Create
                            Profile</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>