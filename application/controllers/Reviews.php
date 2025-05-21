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
        $this->load->model('Company_model');
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->library('email');
        $this->load->library('session');

        // Load ChatGPT library
        $this->load->library('ChatGpt');

        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        // Get user role
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);

        // Allow access if user is admin or super admin
        if (!$user || ($user['role'] !== 'admin' && $user['role'] !== 'super_admin')) {
            redirect('login');
        }
    }

    public function form($user_id = null, $review_type = null)
    {
        // Get company data for the specific user
        $company = $this->Company_model->get_company_by_user($user_id);

        if (!$company) {
            show_error('Company information not found');
        }

        // Check if company_logo exists and is not empty
        $company_logo = !empty($company['company_logo']) ? $company['company_logo'] : 'assets/images/default-logo.png';

        $data = [
            'company_name' => $company['company_name'],
            'company_logo' => $company_logo,
            'google_url' => $company['google_url'],
            'user_id' => $user_id,
            'review_type' => $review_type,
            'admin_id' => $company['user_id'],
            'title' => 'Review Form'
        ];

        // Load only the review form view without header and footer
        $this->load->view('reviews/review_form', $data);
    }

    public function generate_ai_review()
    {
        try {
            $this->load->model('Company_model');
            $admin_id = $this->session->userdata('user_id');

            // Get user_id from the form submission
            $user_id = $this->input->post('user_id');
            log_message('debug', 'Generating AI review for user_id: ' . $user_id);

            // Get company data for the specific user
            $company = $this->Company_model->get_company_by_user($user_id);

            if (!$company) {
                log_message('error', 'Company not found for user_id: ' . $user_id);
                throw new Exception('Company information not found');
            }

            $starRating = (int)$this->input->post('selectedStar');
            $review_type = (int)$this->input->post('review_type');
            log_message('debug', 'Star rating: ' . $starRating . ', Review type: ' . $review_type);

            if ($starRating >= 4) {
                if ($review_type == 1) {
                    // GPT Review - Generate and show AI review
                    log_message('debug', 'Generating GPT review for company: ' . $company['company_name']);

                    // Get keywords for the admin
                    $keywords = $this->Keywords_model->get_all_active_keywords($admin_id);
                    if (empty($keywords)) {
                        log_message('warning', 'No keywords found for admin_id: ' . $admin_id);
                        $keywords = [
                            ['keyword' => 'excellent service'],
                            ['keyword' => 'high quality'],
                            ['keyword' => 'great experience']
                        ];
                    }

                    $ai_review = $this->chatgpt->generate_review(
                        $starRating,
                        array_column($keywords, 'keyword'),
                        $company['company_name'],
                        $company['company_location'] ?? null
                    );

                    if (!$ai_review) {
                        log_message('error', 'Failed to generate AI review');
                        throw new Exception('Failed to generate AI review. Please check the logs for details.');
                    }

                    log_message('debug', 'Generated AI review: ' . $ai_review);

                    $data = [
                        'ai_review' => $ai_review,
                        'company_name' => $company['company_name'],
                        'company_logo' => $company['company_logo'],
                        'google_url' => $company['google_url'],
                        'admin_id' => $admin_id,
                        'title' => 'AI Generated Review'
                    ];

                    $this->load->view('reviews/ai_review', $data);
                } else if ($review_type == 2) {
                    // Normal Review - Redirect to Google URL
                    if (!empty($company['google_url'])) {
                        redirect($company['google_url']);
                    } else {
                        throw new Exception('Google review URL not configured for this company.');
                    }
                }
            } else {
                // For 1-3 star ratings, show the review form
                $data = [
                    'company_name' => $company['company_name'],
                    'company_logo' => $company['company_logo'],
                    'user_id' => $user_id,
                    'review_type' => $review_type,
                    'admin_id' => $admin_id,
                    'title' => 'Review Form'
                ];
                $this->load->view('reviews/review_form', $data);
            }
        } catch (Exception $e) {
            log_message('error', 'Error in generate_ai_review: ' . $e->getMessage());
            show_error($e->getMessage());
        }
    }

    public function save()
    {
        $admin_id = $this->session->userdata('user_id');
        $starRating = (int) $this->input->post('selectedStar', TRUE);
        $data = [
            'comments' => $this->input->post('text_review', TRUE),
            'name_add' => $this->input->post('enter_name', TRUE),
            'mobile_no' => $this->input->post('enter_mobile', TRUE),
            'star_rating' => $starRating,
            'admin_id' => $admin_id
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
                        'smtp_crypto' => $smtp['encryption'],
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
        $admin_id = $this->session->userdata('user_id');

        // Fetch user data to check role
        $user = $this->User_model->get_user_by_id($admin_id);
        $is_super_admin = ($user['role'] === 'super_admin');

        // Get reviews based on role
        $data['reviews'] = $this->Comments_model->get_reviews($is_super_admin ? null : $admin_id);
        $data['title'] = 'Reviews';
        $data['admin_id'] = $admin_id;
        $data['is_super_admin'] = $is_super_admin;

        $this->load->view('templates/header', $data);
        $this->load->view('reviews/index', $data);
        $this->load->view('templates/footer');
    }

    public function dashboard()
    {
        $admin_id = $this->session->userdata('user_id');

        // Fetch user data
        $user = $this->User_model->get_user_by_id($admin_id);

        // Extract username, with a fallback if not found
        $user_name = $user ? $user['username'] : 'User';

        // Check if user is super admin
        $is_super_admin = ($user['role'] === 'super_admin');

        // If super admin, don't filter by admin_id
        $rating_counts = $this->Comments_model->get_rating_counts($is_super_admin ? null : $admin_id);
        $total_reviews = array_sum(array_column($rating_counts, 'count'));

        $total_score = 0;
        foreach ($rating_counts as $rating) {
            $total_score += $rating['star_rating'] * $rating['count'];
        }
        $average_rating = $total_reviews > 0 ? round($total_score / $total_reviews, 1) : 0;

        // Calculate growth rate based on average rating comparison
        $current_date = date('Y-m-d');
        $week_ago = date('Y-m-d', strtotime('-7 days'));

        // Initialize growth_rate
        $growth_rate = 0;

        // Get current week's average rating
        $current_avg_rating = $this->Comments_model->get_average_rating_for_period(
            $is_super_admin ? null : $admin_id,
            $week_ago,
            $current_date
        );

        // Get previous week's average rating
        $two_weeks_ago = date('Y-m-d', strtotime('-14 days'));
        $previous_avg_rating = $this->Comments_model->get_average_rating_for_period(
            $is_super_admin ? null : $admin_id,
            $two_weeks_ago,
            $week_ago
        );

        // Calculate growth rate
        if ($previous_avg_rating > 0) {
            $growth_rate = (($current_avg_rating - $previous_avg_rating) / $previous_avg_rating) * 100;
        }

        // Get recent activities (last 10 reviews)
        $recent_activities = $this->Comments_model->get_recent_reviews($is_super_admin ? null : $admin_id);

        // Calculate daily review trends for the chart
        $daily_trends = $this->Comments_model->get_daily_review_trends($is_super_admin ? null : $admin_id);
        $trend_labels = [];
        $trend_data = [];
        foreach ($daily_trends as $trend) {
            $trend_labels[] = date('M d', strtotime($trend['date']));
            $trend_data[] = $trend['count'];
        }

        // Calculate rating distribution for the doughnut chart
        $distribution_data = array_fill(0, 3, 0); // Initialize array for 3 stars
        foreach ($rating_counts as $rating) {
            if ($rating['star_rating'] >= 1 && $rating['star_rating'] <= 3) {
                $distribution_data[$rating['star_rating'] - 1] = (int)$rating['count'];
            }
        }
        // Reverse the array to show 3 stars first
        $distribution_data = array_reverse($distribution_data);

        $data = [
            'title' => 'Dashboard',
            'user_name' => $user_name,
            'rating_counts' => $rating_counts,
            'total_reviews' => $total_reviews,
            'total_comments' => $total_reviews,
            'average_rating' => $average_rating,
            'positive_reviews' => 0,
            'negative_reviews' => 0,
            'positive_percentage' => 0,
            'negative_percentage' => 0,
            'growth_percentage' => $growth_rate,
            'recent_activities' => $recent_activities,
            'trend_labels' => $trend_labels,
            'trend_data' => $trend_data,
            'distribution_data' => $distribution_data,
            'admin_id' => $admin_id,
            'is_super_admin' => $is_super_admin
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
