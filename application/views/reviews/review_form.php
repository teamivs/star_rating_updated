<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        .cont {
            margin: 40px auto;
            max-width: 500px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .company-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            text-align: center;
        }

        .image_box_add {
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .image_box_add img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 50%;
        }

        .company-name {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 0;
            text-align: center;
        }

        .stars {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .stars input {
            display: none;
        }

        .stars label {
            font-size: 38px;
            text-align: center;
            color: rgb(208, 208, 208);
            margin: 0 5px;
            cursor: pointer;
        }

        .stars input:checked~label,
        .stars label:hover,
        .stars label:hover~label {
            color: #ffca08;
        }

        .stars {
            direction: rtl;
        }

        .review-input,
        .review {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .save-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
            <h5 class="company-name" id="company-name"><?= $company_name ?></h5>
        </div>

        <div class="stars card-body">
            <form id="reviewForm" action="<?= base_url('reviews/generate_ai_review') ?>" method="POST">
                <input type="hidden" name="selectedStar" id="starRatingValue" value="">
                <input type="hidden" name="review_type" value="<?= $review_type ?>">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
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
        $(document).ready(function () {
            // Handle star rating selection
            $('.star').change(function () {
                var rating = $(this).val();
                $('#starRatingValue').val(rating);
                $('#reviewFormStarRating').val(rating); // Update both hidden inputs

                if (rating >= 4) {
                    // For 4-5 star ratings, submit the form to generate AI review
                    $('#reviewForm').submit();
                } else {
                    // For 1-3 star ratings, show the review form
                    $('.rev-box').show();
                }
            });

            // Also handle the hidden input for the review form
            $('#review-form').on('submit', function (e) {
                e.preventDefault();
                var rating = $('#reviewFormStarRating').val();
                if (!rating) {
                    alert('Please select a star rating');
                    return false;
                }

                $.ajax({
                    url: "<?= site_url('reviews/save'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: 'text',
                    success: function (response) {
                        console.log('Response received:', response);
                        if (response.includes('success')) {
                            window.location.href = "<?= site_url('reviews/thankyou'); ?>";
                        } else {
                            console.log('Response did not contain success:', response);
                            alert('Failed to save review');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX error:', status, error);
                        alert('An error occurred while saving the review');
                    }
                });
            });
        });
    </script>
</body>

</html>