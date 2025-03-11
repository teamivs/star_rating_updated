<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f3f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-container {
            padding-left: 250px;
        }

        .dashboard-wrapper {
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card {
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
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

        .rating-bar {
            height: 8px;
            border-radius: 5px;
            background-color: #0d6efd;
        }
    </style>
</head>

<body>
    <?php $this->load->view('components/sidebar'); ?>
    <?php $this->load->view('components/navbar'); ?>

    <div class="main-container">
        <div class="dashboard-wrapper">
            <h2>Good morning, <?= $user_name; ?></h2>
            <p>See what's happening with your company</p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="dashboard-card">
                        <h5>Overall Performance</h5>
                        <div>
                            <h1><?= $average_rating; ?></h1>
                            <div class="stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="star <?= ($i <= round($average_rating)) ? 'filled' : ''; ?>">&#9733;</span>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <p><?= $total_reviews; ?> product reviews</p>
                    </div>
                </div>
            </div>

            <div class="dashboard-card mt-4">
                <h5>Your Reviews</h5>
                <?php foreach ($rating_counts as $rating): ?>
                    <div class="d-flex align-items-center mb-3">
                        <div style="width: 40px;"> <?= $rating['star_rating']; ?>&#9733;</div>
                        <div class="flex-grow-1">
                            <div class="rating-bar" style="width: <?= ($rating['count'] / $total_reviews) * 100; ?>%;">
                            </div>
                        </div>
                        <div class="ms-2">(<?= $rating['count']; ?>)</div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>