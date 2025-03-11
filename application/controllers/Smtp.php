<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Smtp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Smtp_model');
        $this->load->helper('url');
        $this->load->library('session');

        // Debugging: Print session data
        if (!$this->session->userdata('username')) {
            echo "Session not set!";
            exit();
            redirect('login'); // Redirect if user is not logged in
        }
    }

    public function index()
    {
        // Fetch SMTP credentials, if available
        $data['credentials'] = $this->Smtp_model->get_smtp_credentials();
        $this->load->view('smtp/index', $data);
    }

    public function edit($id = null)
    {
        // If no ID is passed, treat it as an insert
        if ($id === null) {
            $data['credentials'] = null; // No credentials, so we will add new ones
        } else {
            // Fetch the SMTP credentials for the given ID
            $data['credentials'] = $this->Smtp_model->get_smtp_by_id($id);

            // If no credentials found, show 404
            if (!$data['credentials']) {
                show_404();
            }
        }

        // Handle form submission to insert/update the SMTP credentials
        if ($this->input->post()) {
            $smtp_data = [
                'smtp_host' => $this->input->post('smtp_host'),
                'smtp_port' => $this->input->post('smtp_port'),
                'smtp_email' => $this->input->post('smtp_email'),
                'smtp_password' => $this->input->post('smtp_password')
            ];

            // If we're adding new credentials (no ID), insert them
            if ($id === null) {
                if ($this->Smtp_model->insert_smtp($smtp_data)) {
                    $this->session->set_flashdata('success', 'SMTP credentials added successfully!');
                    redirect('index.php/smtp'); // Redirect to the list or home
                } else {
                    $this->session->set_flashdata('error', 'Failed to add SMTP credentials.');
                }
            } else {
                // Otherwise, update the existing credentials
                if ($this->Smtp_model->update_smtp($id, $smtp_data)) {
                    $this->session->set_flashdata('success', 'SMTP credentials updated successfully!');
                    redirect('index.php/smtp'); // Redirect to the list or home
                } else {
                    $this->session->set_flashdata('error', 'Failed to update SMTP credentials.');
                    redirect('index.php/smtp');
                }
            }
        }

        // Load the view with the SMTP data (if available)
        $this->load->view('smtp/edit_smtp', $data);
    }
}
