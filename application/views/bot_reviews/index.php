<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Generate Bot Reviews</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <select id="rating" class="form-control">
                                    <option value="5">5 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="2">2 Stars</option>
                                    <option value="1">1 Star</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="category">Keyword Category</label>
                                <select id="category" class="form-control">
                                    <option value="">Random</option>
                                    <option value="service_quality">Service Quality</option>
                                    <option value="product_quality">Product Quality</option>
                                    <option value="customer_experience">Customer Experience</option>
                                    <option value="business_specific">Business Specific</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="count">Number of Reviews</label>
                                <input type="number" id="count" class="form-control" min="1" max="10" value="1">
                            </div>
                            
                            <button id="generate-btn" class="btn btn-primary">Generate Reviews</button>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <h5><i class="icon fas fa-info"></i> Note!</h5>
                                This tool generates reviews using AI. Please use responsibly and ensure compliance with platform policies.
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <div id="reviews-container" style="display: none;">
                                <h4>Generated Reviews</h4>
                                <div id="reviews-list" class="list-group mb-3"></div>
                                <div class="mt-3">
                                    <button id="submit-btn" class="btn btn-success">Submit Reviews</button>
                                    <a id="google-link" href="#" target="_blank" class="btn btn-info ml-2">Open Google Review Page</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Move script to the bottom and ensure jQuery is loaded -->
<script type="text/javascript">
    // Wait for document and jQuery to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Check if jQuery is loaded
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded!');
            return;
        }
        
        console.log('Document ready - Bot Reviews page loaded');
        let generatedReviews = [];
        let googleUrl = '';
        
        // Generate reviews button click
        $('#generate-btn').click(function() {
            console.log('Generate button clicked');
            const rating = $('#rating').val();
            const category = $('#category').val();
            const count = $('#count').val();
            
            console.log('Form values:', { rating, category, count });
            
            // Disable button and show loading state
            $('#generate-btn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Generating...');
            
            // Log the AJAX request details
            const ajaxUrl = '<?php echo site_url("bot_reviews/generate"); ?>';
            console.log('Making AJAX request to:', ajaxUrl);
            
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    rating: rating,
                    category: category,
                    count: count
                },
                dataType: 'json',
                success: function(response) {
                    console.log('AJAX success response:', response);
                    
                    // Show the reviews container
                    $('#reviews-container').show();
                    
                    if (response.success) {
                        // Clear previous reviews
                        $('#reviews-list').empty();
                        
                        // Store generated reviews for submission
                        generatedReviews = response.reviews;
                        
                        // Add new reviews
                        if (response.reviews && response.reviews.length > 0) {
                            response.reviews.forEach(function(review) {
                                let stars = '';
                                for (let i = 0; i < review.rating; i++) {
                                    stars += '<i class="fas fa-star text-warning"></i>';
                                }
                                
                                $('#reviews-list').append(
                                    '<div class="review-item mb-3">' +
                                    '<div class="stars mb-2">' + stars + '</div>' +
                                    '<div class="review-text">' + review.text + '</div>' +
                                    '</div>'
                                );
                            });
                            
                            // Show success message
                            if (response.errors && response.errors.length > 0) {
                                $('#reviews-container').prepend(
                                    '<div class="alert alert-warning">' +
                                    'Generated ' + response.reviews.length + ' reviews. ' +
                                    response.errors.length + ' reviews failed to generate.' +
                                    '</div>'
                                );
                            } else {
                                $('#reviews-container').prepend(
                                    '<div class="alert alert-success">' +
                                    'Successfully generated ' + response.reviews.length + ' reviews!' +
                                    '</div>'
                                );
                            }
                        } else {
                            $('#reviews-container').prepend(
                                '<div class="alert alert-warning">' +
                                'No reviews were generated. Please try again.' +
                                '</div>'
                            );
                        }
                    } else {
                        $('#reviews-container').prepend(
                            '<div class="alert alert-danger">' +
                            (response.message || 'Failed to generate reviews. Please try again.') +
                            '</div>'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', { xhr, status, error });
                    console.error('Response text:', xhr.responseText);
                    
                    // Show the reviews container
                    $('#reviews-container').show();
                    
                    $('#reviews-container').prepend(
                        '<div class="alert alert-danger">' +
                        'An error occurred while generating reviews. Please try again later.' +
                        '</div>'
                    );
                },
                complete: function() {
                    console.log('AJAX request completed');
                    // Re-enable button and restore original text
                    $('#generate-btn').prop('disabled', false).html('Generate Reviews');
                }
            });
        });
        
        // Submit reviews button click
        $('#submit-btn').click(function() {
            if (generatedReviews.length === 0) {
                alert('No reviews to submit.');
                return;
            }
            
            // Show loading
            $('#submit-btn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Submitting...');
            
            // Call API to submit reviews
            $.ajax({
                url: '<?php echo site_url('bot_reviews/submit'); ?>',
                type: 'POST',
                data: {
                    reviews: generatedReviews
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        googleUrl = response.google_url;
                        $('#google-link').attr('href', googleUrl);
                        
                        let resultsHtml = '<div class="alert alert-success">Reviews submitted successfully!</div>';
                        resultsHtml += '<ul class="list-group">';
                        
                        response.results.forEach(function(result) {
                            resultsHtml += `<li class="list-group-item ${result.success ? 'list-group-item-success' : 'list-group-item-danger'}">
                                ${result.message}
                            </li>`;
                        });
                        
                        resultsHtml += '</ul>';
                        $('#reviews-list').html(resultsHtml);
                    } else {
                        $('#reviews-list').html(`<div class="alert alert-danger">${response.message}</div>`);
                    }
                    
                    $('#submit-btn').prop('disabled', false).html('Submit Reviews');
                },
                error: function() {
                    $('#reviews-list').html('<div class="alert alert-danger">Error connecting to server.</div>');
                    $('#submit-btn').prop('disabled', false).html('Submit Reviews');
                }
            });
        });
    });
</script>
