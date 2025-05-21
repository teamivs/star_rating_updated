<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Generated Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        .review-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .review-text {
            font-size: 16px;
            line-height: 1.6;
            margin: 20px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #28a745;
            white-space: pre-wrap;
        }

        .btn-copy {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-copy:hover {
            background-color: #5a6268;
        }

        .btn-next {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-next:hover {
            background-color: #218838;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .company-info {
            text-align: center;
            margin-bottom: 30px;
        }

        .company-logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .error-message {
            color: #dc3545;
            padding: 15px;
            margin: 20px 0;
            border: 1px solid #dc3545;
            border-radius: 5px;
            background-color: #f8d7da;
        }
    </style>
</head>

<body>
    <div class="review-container">
        <div class="company-info">
            <img src="<?= base_url($company_logo) ?>" alt="Company Logo" class="company-logo">
            <h3><?= htmlspecialchars($company_name) ?></h3>
        </div>

        <?php if (empty($ai_review)): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                Failed to generate review. Please try again.
            </div>
        <?php else: ?>
            <div class="review-text" id="reviewText">
                <?= nl2br(htmlspecialchars($ai_review)) ?>
            </div>

            <div class="button-container">
                <button class="btn-copy" onclick="copyReview()">
                    <i class="fas fa-copy"></i> Copy Review
                </button>
                <button class="btn-next" onclick="proceedToGoogle()">
                    Next <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function copyReview() {
            const reviewText = document.getElementById('reviewText').innerText;
            navigator.clipboard.writeText(reviewText).then(() => {
                alert('Review copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }

        function proceedToGoogle() {
            const googleUrl = '<?= $google_url ?>';
            if (googleUrl) {
                window.location.href = googleUrl;
            } else {
                alert('Google review URL not configured for this company.');
            }
        }
    </script>
</body>

</html>