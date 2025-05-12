<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Smtp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Smtp_model');
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'form_validation']);

        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['credentials'] = $this->Smtp_model->get_smtp_credentials();
        $data['title'] = 'SMTP Settings';
        $data['user_name'] = $this->session->userdata('username');

        $this->load->view('templates/header', $data);
        $this->load->view('smtp/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        $data['title'] = 'Edit SMTP Settings';
        $data['user_name'] = $this->session->userdata('username');

        if ($this->input->post()) {
            // Form Validation
            $this->form_validation->set_rules('smtp_host', 'SMTP Host', 'required');
            $this->form_validation->set_rules('smtp_port', 'SMTP Port', 'required|numeric');
            $this->form_validation->set_rules('smtp_email', 'SMTP Email', 'required|valid_email');
            $this->form_validation->set_rules('encryption', 'Encryption', 'required');
            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('smtp/edit');
            }

            $credentials = [
                'smtp_host' => $this->input->post('smtp_host'),
                'smtp_port' => $this->input->post('smtp_port'),
                'smtp_email' => $this->input->post('smtp_email'),
                'encryption' => $this->input->post('encryption')
            ];

            // Only update password if provided
            if (!empty($this->input->post('smtp_password'))) {
                $credentials['smtp_password'] = $this->input->post('smtp_password');
            }

            if ($id) {
                // Update existing credentials
                if ($this->Smtp_model->update_credentials($id, $credentials)) {
                    $this->session->set_flashdata('success', 'SMTP credentials updated successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update SMTP credentials.');
                }
            } else {
                // Save new credentials
                if ($this->Smtp_model->save_credentials($credentials)) {
                    $this->session->set_flashdata('success', 'SMTP credentials saved successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Failed to save SMTP credentials.');
                }
            }

            redirect('smtp');
        }

        $data['credentials'] = $this->Smtp_model->get_smtp_credentials();
        $this->load->view('templates/header', $data);
        $this->load->view('smtp/edit_smtp', $data);
        $this->load->view('templates/footer');
    }
}
