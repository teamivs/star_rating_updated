<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            background-color: #f8f9fa;
        }
        .thank-you-container {
            margin: 100px auto;
            max-width: 600px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background-color: white;
            text-align: center;
        }
        .thank-you-icon {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .thank-you-title {
            font-size: 28px;
            margin-bottom: 15px;
            color: #333;
        }
        .thank-you-message {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }
        .back-button {
            padding: 10px 25px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="thank-you-container">
        <div class="thank-you-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1 class="thank-you-title">Thank You for Your Review!</h1>
        <p class="thank-you-message">
            We appreciate you taking the time to share your experience with us. Your feedback helps us improve our services and helps other customers make informed decisions.
        </p>
        <p class="thank-you-message">
            If you have any additional comments or suggestions, please don't hesitate to contact us directly.
        </p>
        <a href="<?= site_url(); ?>" class="back-button">Return to Homepage</a>
    </div>
</body>
</html> 