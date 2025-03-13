<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Review Dashboard</title>
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
                background-color: #f1f3f5;
                font-family: 'Poppins', sans-serif;
            }

            .main-container {
                margin-left: 20%;
                padding: 20px;
            }

            .dashboard-wrapper {
                background-color: #fff;
                border-radius: 15px;
                margin: 10px;
                padding: 30px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            .dashboard-card {
                border-radius: 12px;
                padding: 20px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                background-color: #fff;
                margin-bottom: 20px;
            }

            .dashboard-card h5 {
                color: #007bff;
                font-weight: 600;
            }

            .rating-bar {
                height: 8px;
                border-radius: 5px;
                background-color: #0d6efd;
            }

            .content-wrapper {
                background-color: #e9ecef;
                border-radius: 10px;
                padding: 20px;
            }

            .stars {
                display: inline-block;
            }

            .star {
                font-size: 24px;
                color: #e9ecef;
            }

            .star.filled {
                color: #f7c948;
            }

            @media (max-width: 768px) {
                .main-container {
                    margin-left: 10%;
                    margin-top: 25px;
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

                <div class="main-container">
                    <div class="content-wrapper">
                        <?php if ($this->session->userdata('type') == 1): ?>
                            <h2>Hello, <?= $user_name; ?></h2>
                            <p>See what's happening with your company</p>
                            <div class="dashboard-wrapper">
                                <div class="dashboard-card mt-4">
                                    <h5>Your Reviews</h5>
                                    <?php foreach ($rating_counts as $rating): ?>
                                        <div class="d-flex align-items-center mb-3">
                                            <div style="width: 40px;"> <?= $rating['star_rating']; ?>&#9733;</div>
                                            <div class="flex-grow-1">
                                                <div class="rating-bar"
                                                    style="width: <?= ($rating['count'] / $total_reviews) * 100; ?>%;"></div>
                                            </div>
                                            <div class="ms-2">(<?= $rating['count']; ?>)</div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <h2>Hello, <?= $user_name; ?></h2>
                            <p>Overview of the platform</p>
                            <div class="dashboard-wrapper">
                                <div class="dashboard-card mt-4">
                                    <h5>Platform Statistics</h5>
                                    <p>Number of Users: 150</p>
                                    <p>Number of Companies Registered: 50</p>
                                    <p>Other relevant details...</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>