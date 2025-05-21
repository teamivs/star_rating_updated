<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        body {
            font-family: 'Google Sans', sans-serif;
            font-size: 28px;
            background-color: rgb(255, 255, 255);
            min-height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px;
            padding: 20px;
            border-radius: 2px;
        }

        .cont {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin: 20px;
            max-width: 600px;
            width: 100%;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid black;
            background: white;
            box-shadow: 0 8px 10px rgba(0, 0, 0, 0.25);
        }

        .company-info {
            display: flex;
            align-items: center;
            justify-content: center;
            /* center everything horizontally */
            gap: 15px;
            /* space between image and text */
            margin-bottom: 10px;
            text-align: left;
            width: 100%;
        }

        .image_box_add {
            width: 70px;
            height: 70px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image_box_add img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .company-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .company-name {
            font-size: 22px;
            font-weight: 500;
            color: black;
        }

        .posting-info {
            font-size: 18px;
            color: darkslategrey;
            margin: 0;
        }

        .stars {
            display: flex;
            justify-content: center;
            margin: 10px;
            gap: 12px;
        }

        .stars input {
            display: none;
        }

        .stars label {
            font-size: 50px;
            color: #dadce0;
            cursor: pointer;
            transition: transform 0.2s ease, color 0.2s ease;
            display: inline-block;
            text-shadow:
                -1px -1px 0 #000,
                1px -1px 0 #000,
                -1px 1px 0 #000,
                1px 1px 0 #000;
            /* Black border (fake outline using shadow) */
        }

        .stars label:hover {
            transform: scale(1.3) rotate(-20deg);
        }

        .stars input:checked~label,
        .stars label:hover,
        .stars label:hover~label {
            color: #fbbc04;
        }

        .stars {
            direction: rtl;
        }

        .review-input,
        .review {
            width: 100%;
            margin: 12px 0;
            padding: 12px 16px;
            border: 1px solid #dadce0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.2s ease;
        }

        .review-input:focus,
        .review:focus {
            outline: none;
            border-color: #1a73e8;
        }

        .save-btn {
            padding: 12px 24px;
            background-color: #fbbc65;
            color: black;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }

        .save-btn:hover {
            background-color: #fbbc05;
        }

        .rev-box {
            margin-top: 20px;
        }

        @media (max-width: 480px) {
            .cont {
                padding: 20px;
            }

            .company-name {
                font-size: 20px;
            }

            .stars label {
                font-size: 40px;
            }
        }
    </style>
</head>

<body>
    <div class="cont">
        <div class="company-info">
            <div class="image_box_add">
                <img id="company-logo" src="<?= base_url($company_logo) ?>" alt="Company Logo"
                    onerror="this.src='<?= base_url('assets/images/default-logo.png') ?>'">
            </div>
            <div class="company-details">
                <h5 class="company-name" id="company-name"><?= $company_name ?></h5>
                <p class="posting-info">Posting publicly across Google</p>
            </div>
        </div>

        <div class="stars card-body">
            <form id="reviewForm" action="<?= base_url('reviews/generate_ai_review') ?>" method="POST">
                <input type="hidden" name="selectedStar" id="starRatingValue" value="">
                <input type="hidden" name="review_type" value="<?= $review_type ?>">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                <input class="star" id="star-5" type="radio" name="star" value="5" />
                <label for="star-5">★</label>
                <input class="star" id="star-4" type="radio" name="star" value="4" />
                <label for="star-4">★</label>
                <input class="star" id="star-3" type="radio" name="star" value="3" />
                <label for="star-3">★</label>
                <input class="star" id="star-2" type="radio" name="star" value="2" />
                <label for="star-2">★</label>
                <input class="star" id="star-1" type="radio" name="star" value="1" />
                <label for="star-1">★</label>
            </form>
        </div>

        <div class="rev-box" style="display: none;">
            <form id="review-form">
                <input type="hidden" name="review_type" value="<?= $review_type ?>">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                <input type="text" class="form-control review-input" name="enter_name" id="enter_name"
                    placeholder="Enter Name">
                <input type="number" class="form-control review-input" name="enter_mobile" id="enter_mobile"
                    placeholder="Enter Mobile Number">
                <textarea class="review" name="text_review" id="text_review" cols="40" rows="5"
                    placeholder="Enter Comment..."></textarea>
                <input type="hidden" name="selectedStar" id="reviewFormStarRating">
                <button type="submit" class="save-btn">Save</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.star').change(function() {
                var rating = $(this).val();
                $('#starRatingValue').val(rating);
                $('#reviewFormStarRating').val(rating);

                // For 4-5 star ratings, submit the form immediately
                if (rating >= 4) {
                    $('#reviewForm').submit();
                } else {
                    // For 1-3 star ratings, show the review form
                    $('.rev-box').show();
                }
            });

            $('#review-form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: '<?= base_url("reviews/save") ?>',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        window.location.href = '<?= base_url("reviews/thankyou") ?>';
                    },
                    error: function() {
                        alert('Error submitting review. Please try again.');
                    }
                });
            });
        });
    </script>
</body>

</html>