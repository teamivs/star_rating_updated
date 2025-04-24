<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bot_reviews extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('keywords_model');
        $this->load->library('chatgpt');
    }
    
    /**
     * Display the bot reviews dashboard
     */
    public function index() {
        $data['title'] = 'Bot Reviews';
        
        $this->load->view('templates/header', $data);
        $this->load->view('bot_reviews/index', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Generate reviews using ChatGPT
     */
    public function generate() {
        // Validate input
        $rating = $this->input->post('rating');
        $count = $this->input->post('count');
        $category = $this->input->post('category');
        
        if (!$rating || !$count) {
            $this->output->set_status_header(400);
            echo json_encode([
                'success' => false,
                'message' => 'Rating and count are required'
            ]);
            return;
        }
        
        // Validate rating
        if (!is_numeric($rating) || $rating < 1 || $rating > 5) {
            $this->output->set_status_header(400);
            echo json_encode([
                'success' => false,
                'message' => 'Rating must be between 1 and 5'
            ]);
            return;
        }
        
        // Validate count
        if (!is_numeric($count) || $count < 1 || $count > 10) {
            $this->output->set_status_header(400);
            echo json_encode([
                'success' => false,
                'message' => 'Count must be between 1 and 10'
            ]);
            return;
        }
        
        // Get keywords for the category
        $keywords = $this->keywords_model->get_keywords($category);
        
        // Generate reviews
        $reviews = [];
        $errors = [];
        for ($i = 0; $i < $count; $i++) {
            $review_text = $this->chatgpt->generate_review($rating, $keywords);
            if ($review_text) {
                $reviews[] = [
                    'text' => $review_text,
                    'rating' => (int)$rating
                ];
            } else {
                $errors[] = "Failed to generate review #" . ($i + 1);
            }
        }
        
        // Return response
        if (empty($reviews)) {
            $this->output->set_status_header(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to generate any reviews',
                'errors' => $errors
            ]);
            return;
        }
        
        echo json_encode([
            'success' => true,
            'reviews' => $reviews,
            'errors' => $errors
        ]);
    }
    
    /**
     * Submit reviews to Google
     */
    public function submit() {
        // Validate input
        $reviews = $this->input->post('reviews');
        
        if (!$reviews || !is_array($reviews)) {
            $this->output->set_status_header(400);
            echo json_encode([
                'success' => false,
                'message' => 'Invalid reviews data'
            ]);
            return;
        }
        
        // Submit each review
        $results = [];
        foreach ($reviews as $review) {
            if (!isset($review['text']) || !isset($review['rating'])) {
                continue;
            }
            
            // TODO: Implement Google review submission
            // For now, just store in database
            $data = [
                'comments' => $review['text'],
                'star_rating' => $review['rating'],
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('comments', $data);
            $results[] = [
                'success' => true,
                'message' => 'Review submitted successfully'
            ];
        }
        
        echo json_encode([
            'success' => true,
            'results' => $results
        ]);
    }
}
