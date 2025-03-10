<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reviews extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Comments_model'); // Ensure the correct model name
        $this->load->helper('url'); // Load URL helper
    }

 

    public function form()
    {
        $this->load->view('reviews/review_form');
    }
    public function save()
    {
        $data = [
            'comments' => $this->input->post('text_review', TRUE),
            'name_add' => $this->input->post('enter_name', TRUE),
            'mobile_no' => $this->input->post('enter_mobile', TRUE),
            'star_rating' => (int) $this->input->post('selectedStar', TRUE),
        ];

        $result = $this->Comments_model->save_review($data);
        echo $result ? 'success' : 'failure';
    }


    public function index()
    {
        $data['reviews'] = $this->Comments_model->get_reviews();
        $this->load->view('reviews/index', $data);
        // $this->load->view('reviews/review_form', $data); // Pass $data if needed
    }
}
?>