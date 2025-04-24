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

            .stars {
                margin-right: 120px;

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
                    <img id="company-logo" src="" alt="Company Logo">
                </div>
                <div class="text-dark text-start ms-3">
                    <h5 id="company-name"></h5>
                    <label id="company-url"></label>
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
            // Function to get URL parameters
            function getUrlParameter(name) {
                name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                var results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }

            $(document).ready(function () {
                // Fetch company details from URL
                var companyName = getUrlParameter('name');
                var companyLogo = getUrlParameter('logo');
                var companyUrl = getUrlParameter('url');

                // Update the HTML with the fetched data
                $('#company-name').text(companyName);
                $('#company-logo').attr('src', companyLogo);
                $('#company-url').text(companyUrl).attr('href', companyUrl);

                // Review form behavior
                $("input[name='star']").change(function () {
                    let selectedStar = $(this).val();
                    $('#selectedStar').val(selectedStar);

                    if (selectedStar >= 4) {
                        $.ajax({
                            url: "<?= site_url('reviews/save'); ?>",
                            type: "POST",
                            data: { selectedStar: selectedStar },
                            dataType: 'text',
                            success: function (response) {
                                console.log('Star rating response:', response);
                                if (response.includes('success')) {
                                    let googleUrl = "<?= $google_url; ?>";
                                    if (googleUrl) {
                                        window.location.href = googleUrl;
                                    } else {
                                        alert('Google review URL not configured.');
                                    }
                                } else {
                                    console.log('Star rating response did not contain success:', response);
                                    alert('Failed to save review');
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('Star rating AJAX error:', status, error);
                                alert('An error occurred while saving the review');
                            }
                        });
                    } else {
                        $('.rev-box').show();
                    }
                });


                $('#review-form').submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: "<?= site_url('reviews/save'); ?>",
                        type: "POST",
                        data: $(this).serialize(),
                        dataType: 'text',
                        success: function (response) {
                            console.log('Response received:', response);
                            // Check if response contains 'success' anywhere
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