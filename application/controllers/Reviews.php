<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reviews extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Comments_model');
        $this->load->model('Smtp_model');
        $this->load->helper('url');
        $this->load->library('email');
        $this->load->library('session'); // Load the session library
        $this->load->model('User_model');
    }

    public function form()
    {
        $this->load->model('Company_model'); // Load the Company model
        $company = $this->Company_model->get_company(); // Fetch company data

        $data['google_url'] = $company ? $company['google_url'] : '';

        $this->load->view('reviews/review_form', $data);
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
        $this->load->view('reviews/index', $data);
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

        $this->load->view('reviews/dashboard', $data);
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
        $this->load->view('reviews/thankyou');
    }
}
?>