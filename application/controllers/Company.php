<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model');
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'upload', 'form_validation']);

        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }

    public function profile()
    {
        // Only for admin, not super admin
        if ($this->session->userdata('role') !== 'admin') {
            show_404();
        }
        $user_id = $this->session->userdata('user_id');
        $data['company'] = $this->Company_model->get_company_by_user($user_id);
        $data['user_name'] = $this->session->userdata('username');
        $data['title'] = 'Company Profile';

        $this->load->view('templates/header', $data);
        $this->load->view('company/profile', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['company'] = $this->Company_model->get_company();
        $data['user_name'] = $this->session->userdata('username');
        $data['title'] = 'Edit Company Profile';

        if ($this->input->post()) {
            // Form Validation
            $this->form_validation->set_rules('company_name', 'Company Name', 'required');
            $this->form_validation->set_rules('company_url', 'Company URL', 'required|valid_url');
            $this->form_validation->set_rules('google_url', 'Google URL', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('company/edit');
            }

            // Ensure the upload directory exists
            $upload_path = FCPATH . 'uploads/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }

            // Ensure directory is writable
            if (!is_writable($upload_path)) {
                chmod($upload_path, 0755);
            }

            // File Upload Configuration
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->upload->initialize($config);

            // Handle File Upload
            if (!empty($_FILES['company_logo']['name'])) {
                if ($this->upload->do_upload('company_logo')) {
                    $logo = 'uploads/' . $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('company/edit');
                }
            } else {
                $logo = $data['company']['company_logo'] ?? '';
            }

            // Prepare Data
            $company_data = [
                'company_name' => $this->input->post('company_name'),
                'company_logo' => $logo,
                'company_url' => $this->input->post('company_url'),
                'google_url' => $this->input->post('google_url'),
                'company_location' => $this->input->post('company_location')
            ];

            // Save Data
            $user_id = $this->session->userdata('user_id');
            if ($this->Company_model->save_company($user_id, $company_data)) {
                $this->session->set_flashdata('success', 'Company profile updated successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to update company profile.');
            }

            redirect('company/profile');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('company/edit', $data);
        $this->load->view('templates/footer');
    }

}
