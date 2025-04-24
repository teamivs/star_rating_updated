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

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <style>
            :root {
                --primary-color: #4361ee;
                --secondary-color: #3f37c9;
                --success-color: #4cc9f0;
                --warning-color: #f72585;
                --info-color: #4895ef;
            }

            body {
                background-color: #f8f9fa;
                font-family: 'Poppins', sans-serif;
            }

            .main-container {
                margin-left: 20%;
                padding: 20px;
                transition: all 0.3s ease;
            }

            .dashboard-wrapper {
                background-color: #fff;
                border-radius: 15px;
                margin: 10px;
                padding: 30px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
            }

            .dashboard-wrapper:hover {
                transform: translateY(-5px);
            }

            .stat-card {
                border-radius: 12px;
                padding: 20px;
                background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
                color: white;
                margin-bottom: 20px;
                transition: all 0.3s ease;
            }

            .stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            }

            .stat-card i {
                font-size: 2.5rem;
                margin-bottom: 10px;
            }

            .stat-card h3 {
                font-size: 2rem;
                margin: 10px 0;
            }

            .stat-card p {
                margin: 0;
                opacity: 0.8;
            }

            .rating-bar {
                height: 8px;
                border-radius: 5px;
                background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
                transition: width 0.3s ease;
            }

            .content-wrapper {
                background-color: #fff;
                border-radius: 15px;
                padding: 20px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            .chart-container {
                background: white;
                border-radius: 12px;
                padding: 20px;
                margin-bottom: 20px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            }

            .activity-feed {
                max-height: 400px;
                overflow-y: auto;
            }

            .activity-item {
                padding: 15px;
                border-left: 3px solid var(--primary-color);
                margin-bottom: 10px;
                background: #f8f9fa;
                border-radius: 0 10px 10px 0;
            }

            .welcome-section {
                background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
                color: white;
                padding: 30px;
                border-radius: 15px;
                margin-bottom: 30px;
            }

            .welcome-section h2 {
                font-size: 2.5rem;
                margin-bottom: 10px;
            }

            .progress {
                height: 10px;
                border-radius: 5px;
            }

            @media (max-width: 768px) {
                .main-container {
                    margin-left: 0;
                    margin-top: 25px;
                }
            }

            .star {
                color: #ffd700;
                font-size: 20px;
            }

            .trend-indicator {
                font-size: 0.9rem;
                padding: 5px 10px;
                border-radius: 20px;
                margin-left: 10px;
            }

            .trend-up {
                background-color: rgba(76, 201, 240, 0.2);
                color: var(--success-color);
            }

            .trend-down {
                background-color: rgba(247, 37, 133, 0.2);
                color: var(--warning-color);
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
                    <div class="welcome-section">
                        <h2>Welcome back, <?= $user_name; ?>! 👋</h2>
                        <p class="mb-0">Here's what's happening with your reviews today</p>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="stat-card">
                                <i class="fas fa-star"></i>
                                <h3><?= $total_reviews; ?></h3>
                                <p>Total Reviews</p>
                                <span class="trend-indicator trend-up">
                                    <i class="fas fa-arrow-up"></i> 12%
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card" style="background: linear-gradient(45deg, #4cc9f0, #4895ef);">
                                <i class="fas fa-thumbs-up"></i>
                                <h3><?= number_format(($positive_reviews / $total_reviews) * 100, 1); ?>%</h3>
                                <p>Positive Reviews</p>
                                <span class="trend-indicator trend-up">
                                    <i class="fas fa-arrow-up"></i> 5%
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card" style="background: linear-gradient(45deg, #f72585, #b5179e);">
                                <i class="fas fa-comments"></i>
                                <h3><?= $total_comments; ?></h3>
                                <p>Total Comments</p>
                                <span class="trend-indicator trend-up">
                                    <i class="fas fa-arrow-up"></i> 8%
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card" style="background: linear-gradient(45deg, #3f37c9, #4361ee);">
                                <i class="fas fa-chart-line"></i>
                                <h3><?= number_format($average_rating, 1); ?></h3>
                                <p>Average Rating</p>
                                <span class="trend-indicator trend-up">
                                    <i class="fas fa-arrow-up"></i> 3%
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-8">
                            <div class="chart-container">
                                <h5 class="mb-4">Review Trends</h5>
                                <canvas id="reviewTrendsChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="chart-container">
                                <h5 class="mb-4">Rating Distribution</h5>
                                <canvas id="ratingDistributionChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="dashboard-wrapper">
                                <h5 class="mb-4">Rating Breakdown</h5>
                                <?php foreach ($rating_counts as $rating): ?>
                                    <div class="d-flex align-items-center mb-3">
                                        <div style="width: 40px;">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star star" style="color: <?= $i <= $rating['star_rating'] ? '#ffd700' : '#e9ecef'; ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" 
                                                    style="width: <?= ($rating['count'] / $total_reviews) * 100; ?>%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ms-2"><?= $rating['count']; ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="dashboard-wrapper">
                                <h5 class="mb-4">Recent Activity</h5>
                                <div class="activity-feed">
                                    <?php foreach($recent_activities as $activity): ?>
                                        <div class="activity-item">
                                            <div class="d-flex justify-content-between">
                                                <strong><?= $activity['user_name']; ?></strong>
                                                <small class="text-muted"><?= $activity['timestamp']; ?></small>
                                            </div>
                                            <p class="mb-0"><?= $activity['action']; ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Review Trends Chart
            const trendsCtx = document.getElementById('reviewTrendsChart').getContext('2d');
            new Chart(trendsCtx, {
                type: 'line',
                data: {
                    labels: <?= json_encode($trend_labels); ?>,
                    datasets: [{
                        label: 'Reviews',
                        data: <?= json_encode($trend_data); ?>,
                        borderColor: '#4361ee',
                        tension: 0.4,
                        fill: true,
                        backgroundColor: 'rgba(67, 97, 238, 0.1)'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Rating Distribution Chart
            const distributionCtx = document.getElementById('ratingDistributionChart').getContext('2d');
            new Chart(distributionCtx, {
                type: 'doughnut',
                data: {
                    labels: ['5 Stars', '4 Stars', '3 Stars', '2 Stars', '1 Star'],
                    datasets: [{
                        data: <?= json_encode($distribution_data); ?>,
                        backgroundColor: [
                            '#4cc9f0',
                            '#4895ef',
                            '#4361ee',
                            '#3f37c9',
                            '#f72585'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        </script>
    </body>

</html>