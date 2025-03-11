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
                margin : 40px auto;
                max-width: 500px;
                /* margin-left: 25%; */
                align-items: center;
                align-content: center;

                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 25px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .image_box_add img {
                width: 80px;
                height: auto;
                border-radius: 50%;
            }
            .stars{
                margin-right:120px;
                
            }
            .stars input {
                display: none;
            }

            .stars label {
                font-size: 38px;
                text-align: center;
                color: rgb(208, 208, 208);
                margin-left: 5px;
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
            <div class="d-flex justify-content-center align-items-center">
                <div class="image_box_add">
                    <img src="https://cibbo.in/wp-content/uploads/2025/01/images-2-2.png" alt="">
                </div>
                <div class="text-dark text-start ms-3">
                    <h5>Cibbo Cafe and Bar | European Cafe and Bar</h5>
                    <label>Posting publicly across Google</label>
                </div>
            </div>

            <div class="stars card-body">
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
            </div>

            <div class="rev-box" style="display: none;">
                <form id="review-form">
                    <input type="text" class="form-control review-input" name="enter_name" id="enter_name"
                        placeholder="Enter Name">
                    <input type="number" class="form-control review-input" name="enter_mobile" id="enter_mobile"
                        placeholder="Enter Mobile Number">
                    <textarea class="review" name="text_review" id="text_review" cols="40" rows="5"
                        placeholder="Enter Comment..."></textarea>
                    <input type="hidden" name="selectedStar" id="selectedStar">
                    <button type="submit" class="save-btn">Save</button>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $("input[name='star']").change(function () {
                    let selectedStar = $(this).val();
                    $('#selectedStar').val(selectedStar);

                    if (selectedStar >= 4) {
                        $.post("<?= site_url('index.php/reviews/save'); ?>", { selectedStar: selectedStar }, function (response) {
                            if (response === 'success') {
                                window.location.href = "<?= site_url('reviews/thankyou'); ?>";
                            } else {
                                alert('Failed to save review');
                            }
                        });
                    } else {
                        $('.rev-box').show();
                    }
                });

                $('#review-form').submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: "<?= site_url('index.php/reviews/save'); ?>",
                        type: "POST",
                        data: $(this).serialize(),
                        success: function (response) {
                            if (response === 'success') {
                                window.location.href = "<?= site_url('reviews/thankyou'); ?>";
                            } else {
                                alert('Failed to save review');
                            }
                        },
                        error: function () {
                            alert('An error occurred while saving the review');
                        }
                    });
                });
            });
        </script>
    </body>

</html>