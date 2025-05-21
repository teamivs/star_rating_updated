<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dashboard</title>

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
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .main-container {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .welcome-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
            width: 100%;
            overflow: hidden;
        }

        .welcome-section h2 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .welcome-section p {
            font-size: 1.1rem;
            margin: 0;
            opacity: 0.9;
        }

        .stat-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            box-shadow: var(--card-shadow);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card .icon-wrapper {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .stat-card .icon-wrapper i {
            font-size: 1.5rem;
            color: white;
        }

        .stat-card .stat-value {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .stat-card .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .chart-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
        }

        .chart-card .card-header {
            background: none;
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
            margin-bottom: 1rem;
        }

        .chart-card .card-header h6 {
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .recent-reviews {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
        }

        .recent-reviews .table {
            margin-bottom: 0;
        }

        .recent-reviews .table th {
            font-weight: 600;
            color: #2c3e50;
            border-top: none;
        }

        .recent-reviews .table td {
            vertical-align: middle;
        }

        .star-rating {
            color: #ffd700;
        }

        .star-rating .far {
            color: #e9ecef;
        }

        @media (max-width: 991.98px) {
            .welcome-section {
                padding: 1.5rem;
            }

            .welcome-section h2 {
                font-size: 1.75rem;
            }

            .welcome-section p {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            .main-container {
                padding: 1rem;
            }

            .welcome-section {
                padding: 1.25rem;
                margin-bottom: 1.5rem;
            }

            .welcome-section h2 {
                font-size: 1.5rem;
            }

            .welcome-section p {
                font-size: 0.95rem;
            }
        }

        @media (max-width: 576px) {
            .welcome-section {
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .welcome-section h2 {
                font-size: 1.25rem;
            }

            .welcome-section p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="welcome-section">
            <h2>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h2>
            <p class="mb-0">Here's your review dashboard overview</p>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="icon-wrapper" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="stat-value"><?php echo $total_reviews; ?></div>
                    <div class="stat-label">Total Reviews</div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="icon-wrapper" style="background: linear-gradient(135deg, #28a745, #20c997);">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-value"><?php echo $average_rating; ?>/5</div>
                    <div class="stat-label">Average Rating</div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="icon-wrapper" style="background: linear-gradient(135deg, var(--info-color), var(--success-color));">
                        <i class="fas fa-thumbs-up"></i>
                    </div>
                    <div class="stat-value"><?php echo $positive_percentage; ?>%</div>
                    <div class="stat-label">Positive Reviews</div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="icon-wrapper" style="background: linear-gradient(135deg, var(--warning-color), #ff6b6b);">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-value"><?php echo $growth_percentage; ?>%</div>
                    <div class="stat-label">Growth Rate</div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row g-4 mb-4">
            <div class="col-xl-8">
                <div class="chart-card">
                    <div class="card-header">
                        <h6>Daily Review Trends</h6>
                    </div>
                    <div class="chart-area" style="height: 300px;">
                        <canvas id="dailyTrendsChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="chart-card">
                    <div class="card-header">
                        <h6>Rating Distribution (3-Star Scale)</h6>
                    </div>
                    <div class="chart-pie" style="height: 300px;">
                        <canvas id="ratingDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reviews -->
        <div class="recent-reviews">
            <div class="card-header">
                <h6>Recent Reviews</h6>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Reviewer</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Mobile No</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_activities as $activity): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($activity['user_name']); ?></td>
                                <td>
                                    <div class="star-rating">
                                        <?php
                                        $rating = isset($activity['star_rating']) ? $activity['star_rating'] : 0;
                                        for ($i = 1; $i <= 5; $i++):
                                        ?>
                                            <i class="fas <?php echo $i <= $rating ? 'fa-star' : 'far fa-star'; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($activity['action']); ?></td>
                                <td><?php echo htmlspecialchars($activity['mobile_no']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($activity['timestamp'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Daily Trends Chart
        var ctx = document.getElementById('dailyTrendsChart').getContext('2d');
        var dailyTrendsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($trend_labels); ?>,
                datasets: [{
                    label: 'Number of Reviews',
                    data: <?php echo json_encode($trend_data); ?>,
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Rating Distribution Chart
        var ctx2 = document.getElementById('ratingDistributionChart').getContext('2d');
        var ratingDistributionChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['3 Stars', '2 Stars', '1 Star'],
                datasets: [{
                    data: <?php echo json_encode($distribution_data); ?>,
                    backgroundColor: [
                        '#28a745', // 3 stars - green
                        '#17a2b8', // 2 stars - blue
                        '#dc3545' // 1 star - red
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                return `${label}: ${value} reviews`;
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    </script>
</body>

</html>