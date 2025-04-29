<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reviews extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Comments_model');
        $this->load->model('Smtp_model');
        $this->load->model('Keywords_model');
        $this->load->helper('url');
        $this->load->library('email');
        $this->load->library('session'); // Load the session library
        $this->load->model('User_model');
    }

    public function form($user_id = null, $review_type = null)
    {
        $this->load->model('Company_model');

        // Get company data for the specific user
        $company = $this->Company_model->get_company_by_user($user_id);

        if (!$company) {
            show_error('Company information not found');
        }

        // Check if company_logo exists and is not empty
        $company_logo = !empty($company['company_logo']) ? $company['company_logo'] : 'assets/images/default-logo.png';

        $data = [
            'company_name' => $company['company_name'],
            'company_logo' => $company_logo, // Pass the raw path
            'google_url' => $company['google_url'],
            'user_id' => $user_id,
            'review_type' => $review_type,
            'title' => 'Review Form'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('reviews/review_form', $data);
        $this->load->view('templates/footer');
    }

    public function generate_ai_review()
    {
        $this->load->model('Company_model');

        // Get user_id from the form submission
        $user_id = $this->input->post('user_id');

        // Get company data for the specific user
        $company = $this->Company_model->get_company_by_user($user_id);

        if (!$company) {
            redirect('reviews/form');
        }

        $starRating = $this->input->post('selectedStar');
        $review_type = $this->input->post('review_type');

        // Only generate AI review for 4-5 star ratings and when review_type is 1
        if ($starRating >= 4 && $review_type == 1) {
            // Generate AI review based on sentiment
            $ai_review = $this->generateReview($starRating, $company['company_name']);

            $data = [
                'ai_review' => $ai_review,
                'company_name' => $company['company_name'],
                'company_logo' => $company['company_logo'],
                'google_url' => $company['google_url'],
                'title' => 'AI Generated Review'
            ];

            $this->load->view('templates/header', $data);
            $this->load->view('reviews/ai_review', $data);
            $this->load->view('templates/footer');
        } else if ($starRating >= 4 && $review_type == 2) {
            // For non-AI reviews with 4-5 stars, redirect to Google URL
            redirect($company['google_url']);
        } else {
            // For 1-3 star ratings, proceed with normal review process
            redirect('reviews/form');
        }
    }

    private function generateReview($rating, $company_name)
    {
        // Get all active keywords from database
        $keywords = $this->Keywords_model->get_all_active_keywords();

        // Group keywords by category
        $keywords_by_category = [];
        foreach ($keywords as $keyword) {
            $keywords_by_category[$keyword['category']][] = $keyword['keyword'];
        }

        // Get available categories
        $categories = array_keys($keywords_by_category);

        // Select 2-3 random categories
        $num_categories = rand(2, 3);
        $selected_categories = array_rand(array_flip($categories), min($num_categories, count($categories)));

        // Select 4-5 random keywords from selected categories
        $selected_keywords = [];
        foreach ($selected_categories as $category) {
            if (isset($keywords_by_category[$category])) {
                $category_keywords = $keywords_by_category[$category];
                if (!empty($category_keywords)) {
                    $num_keywords = rand(1, 2);
                    $category_selected = array_rand(array_flip($category_keywords), min($num_keywords, count($category_keywords)));
                    if (is_array($category_selected)) {
                        $selected_keywords = array_merge($selected_keywords, $category_selected);
                    } else {
                        $selected_keywords[] = $category_selected;
                    }
                }
            }
        }

        // Load ChatGPT library
        $this->load->library('chatgpt');

        // Get company data for the specific user
        $company = $this->Company_model->get_company_by_user($this->input->post('user_id'));

        // Generate review using ChatGPT with the specific company name and location
        $review = $this->chatgpt->generate_review($rating, $selected_keywords, $company_name, $company['company_location']);

        if (!$review) {
            // Fallback to a simple review if ChatGPT fails
            $review = "I had a great experience with " . $company_name . ". Their service was excellent and I would highly recommend them.";
        }

        return $review;
    }

    public function save()
    {
        $starRating = (int) $this->input->post('selectedStar', TRUE);
        $data = [
            'comments' => $this->input->post('text_review', TRUE),
            'name_add' => $this->input->post('enter_name', TRUE),
            'mobile_no' => $this->input->post('enter_mobile', TRUE),
            'star_rating' => $starRating,
        ];

        // Save review to the database
        $result = $this->Comments_model->save_review($data);

        if ($result) {
            // Send email only for 1-3 star ratings
            if ($starRating <= 3) {
                $smtp = $this->Smtp_model->get_smtp_credentials();

                if ($smtp) {
                    // Configure email settings dynamically
                    $config = [
                        'protocol' => 'smtp',
                        'smtp_host' => $smtp['smtp_host'],
                        'smtp_port' => $smtp['smtp_port'],
                        'smtp_user' => $smtp['smtp_email'],
                        'smtp_pass' => $smtp['smtp_password'],
                        'smtp_crypto' => 'tls',
                        'mailtype' => 'html',
                        'charset' => 'utf-8',
                        'newline' => "\r\n",
                        'wordwrap' => TRUE,
                        'smtp_timeout' => 30,
                    ];

                    $this->email->initialize($config);
                    $this->email->from($smtp['smtp_email'], 'Review System');
                    $this->email->to('teamivssoft@gmail.com');
                    $this->email->subject('New Review Submitted');
                    $this->email->message('
                    <html>
                    <head>
                        <title>New Review Submitted</title>
                    </head>
                    <body style="font-family: Arial, sans-serif; color: #000; padding: 20px;">
                        <p>Dear Owner,</p>
                        <p>A new review has been submitted. Here are the details:</p>

                        <p><strong>Reviewer Name:</strong> ' . htmlspecialchars($data['name_add']) . '</p>
                        <p><strong>Reviewer Email:</strong> ' . htmlspecialchars($data['mobile_no']) . '</p>
                        <p><strong>Rating:</strong> ' . htmlspecialchars($data['star_rating']) . ' / 5</p>
                        <p><strong>Comments:</strong> ' . nl2br(htmlspecialchars($data['comments'])) . '</p>
                        <p><strong>Submitted On:</strong> ' . date('Y-m-d H:i:s') . '</p>

                        <p>Best Regards,<br>Your Company Team</p>
                    </body>
                    </html>
                ');

                    if (!$this->email->send()) {
                        echo $this->email->print_debugger(['headers']);
                        log_message('error', 'Email failed to send: ' . $this->email->print_debugger(['headers']));
                    } else {
                        log_message('info', 'Email sent successfully.');
                    }
                } else {
                    log_message('error', 'SMTP credentials not found.');
                }
            }

            // Clear any previous output
            ob_clean();
            // Set content type to plain text
            header('Content-Type: text/plain');
            echo 'success';
            exit;
        } else {
            // Clear any previous output
            ob_clean();
            // Set content type to plain text
            header('Content-Type: text/plain');
            echo 'failure';
            exit;
        }
    }

    public function index()
    {
        $data['reviews'] = $this->Comments_model->get_reviews();
        $data['title'] = 'Reviews';

        $this->load->view('templates/header', $data);
        $this->load->view('reviews/index', $data);
        $this->load->view('templates/footer');
    }

    public function dashboard()
    {
        // Load the User_model if not autoloaded
        $this->load->model('User_model');

        // Get the current user ID from session
        $user_id = $this->session->userdata('user_id');

        // Fetch user data
        $user = $this->User_model->get_user_by_id($user_id);

        // Extract username, with a fallback if not found
        $user_name = $user ? $user['username'] : 'User';

        $rating_counts = $this->Comments_model->get_rating_counts();
        $total_reviews = array_sum(array_column($rating_counts, 'count'));

        $total_score = 0;
        foreach ($rating_counts as $rating) {
            $total_score += $rating['star_rating'] * $rating['count'];
        }

        $average_rating = ($total_reviews > 0) ? round($total_score / $total_reviews, 1) : 0;

        $last_week_reviews = $this->Comments_model->get_review_count_last_week();
        $growth_percentage = ($last_week_reviews > 0)
            ? round((($total_reviews - $last_week_reviews) / $last_week_reviews) * 100, 2)
            : ($total_reviews > 0 ? 100 : 0);

        $positive_reviews = 0;
        $negative_reviews = 0;
        foreach ($rating_counts as $rating) {
            if ($rating['star_rating'] >= 4) {
                $positive_reviews += $rating['count'];
            } else {
                $negative_reviews += $rating['count'];
            }
        }

        $positive_percentage = ($total_reviews > 0)
            ? round(($positive_reviews / $total_reviews) * 100, 2) : 0;
        $negative_percentage = ($total_reviews > 0)
            ? round(($negative_reviews / $total_reviews) * 100, 2) : 0;

        // Get total comments (same as total reviews in this case)
        $total_comments = $total_reviews;

        // Get recent activities (last 10 reviews)
        $recent_activities = $this->Comments_model->get_recent_reviews(10);

        // Calculate monthly review trends for the chart
        $monthly_trends = $this->Comments_model->get_monthly_review_trends();
        $trend_labels = [];
        $trend_data = [];
        foreach ($monthly_trends as $trend) {
            $trend_labels[] = date('M', strtotime($trend['month']));
            $trend_data[] = $trend['count'];
        }

        // Calculate rating distribution for the doughnut chart
        $distribution_data = [];
        foreach ($rating_counts as $rating) {
            $distribution_data[] = $rating['count'];
        }

        $data = [
            'title' => 'Dashboard',
            'user_name' => $user_name,
            'rating_counts' => $rating_counts,
            'total_reviews' => $total_reviews,
            'total_comments' => $total_comments,
            'average_rating' => $average_rating,
            'positive_reviews' => $positive_reviews,
            'negative_reviews' => $negative_reviews,
            'positive_percentage' => $positive_percentage,
            'negative_percentage' => $negative_percentage,
            'growth_percentage' => $growth_percentage,
            'recent_activities' => $recent_activities,
            'trend_labels' => $trend_labels,
            'trend_data' => $trend_data,
            'distribution_data' => $distribution_data
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('reviews/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function logout()
    {
        // Destroy the session
        $this->session->sess_destroy();

        // Redirect to login page
        redirect('login');
    }

    public function thankyou()
    {
        $data['title'] = 'Thank You';

        $this->load->view('templates/header', $data);
        $this->load->view('reviews/thankyou');
        $this->load->view('templates/footer');
    }
}
?>