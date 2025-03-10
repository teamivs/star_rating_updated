<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Review Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .review-container {
            max-width: 500px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .star-rating span {
            font-size: 2rem;
            cursor: pointer;
            color: #ccc;
        }

        .star-rating .selected {
            color: gold;
        }

        .hidden {
            display: none;
        }

        .company-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .company-logo {
            max-height: 60px;
        }
    </style>
</head>

<body>

    <div class="container review-container text-center">
        <div class="company-header">
            <img src="<?= base_url('assets/logo.png') ?>" alt="Company Logo" class="company-logo">
            <h2>Company Name</h2>
        </div>
        <h4>Submit Your Review</h4>
        <div class="star-rating my-3">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <span data-value="<?= $i ?>">&#9733;</span>
            <?php endfor; ?>
        </div>

        <div id="reviewForm" class="hidden">
            <input type="text" class="form-control my-2" name="enter_name" id="enter_name" placeholder="Enter Name">
            <input type="number" class="form-control my-2" name="enter_mobile" id="enter_mobile"
                placeholder="Enter Mobile Number">
            <textarea class="form-control my-2" name="text_review" id="text_review"
                placeholder="Enter Comment..."></textarea>
            <button type="button" class="btn btn-primary mt-2" id="saveReview">Save</button>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            let selectedStar = 0;

            $('.star-rating span').click(function () {
                selectedStar = $(this).data('value');
                $('.star-rating span').removeClass('selected');
                $(this).prevAll().addBack().addClass('selected');

                if (selectedStar <= 3) {
                    $('#reviewForm').removeClass('hidden');
                } else {
                    $('#reviewForm').addClass('hidden');
                     Swal.fire('Review saved successfully!').then(() => {
                            window.location.href = "<?= base_url('thank-you') ?>";
                    });
                }
            });

            $('#saveReview').click(function () {
                const data = {
                    text_review: $('#text_review').val(),
                    enter_name: $('#enter_name').val(),
                    enter_mobile: $('#enter_mobile').val(),
                    selectedStar: selectedStar
                };

                if (!data.enter_name || !data.enter_mobile || !data.text_review || !data.selectedStar) {
                    Swal.fire('Please fill out all fields.');
                    return;
                }

                $.post("<?= base_url('reviews/save') ?>", data, function (response) {
                    if (response === 'success') {
                        Swal.fire('Review saved successfully!').then(() => {
                            window.location.href = "<?= base_url('thank-you') ?>";
                        });
                    } else {
                        Swal.fire('Failed to save review');
                    }
                });
            });
        });
    </script>

</body>

</html>