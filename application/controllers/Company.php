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
        $user_id = $this->session->userdata('user_id');
        $data['company'] = $this->Company_model->get_company_by_user($user_id);
        $data['user_name'] = $this->session->userdata('username');
        $data['title'] = 'Edit Company Profile';

        if ($this->input->post()) {
            $this->form_validation->set_rules('company_name', 'Company Name', 'required');
            $this->form_validation->set_rules('company_url', 'Company URL', 'required|valid_url');
            $this->form_validation->set_rules('google_url', 'Google URL', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('company/edit');
            }

            // Use cropped image if available, otherwise keep existing or empty
            $logo = $this->input->post('cropped_image') ?? $data['company']['company_logo'] ?? '';

            // Prepare Data
            $company_data = [
                'company_name' => $this->input->post('company_name'),
                'company_logo' => $logo,
                'company_url' => $this->input->post('company_url'),
                'google_url' => $this->input->post('google_url'),
                'company_location' => $this->input->post('company_location')
            ];

            // Save Data
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
    // Assuming you have a function to fetch company details by ID
    function getCompanyDetails($companyId)
    {
        // Fetch company details from the database
        $query = "SELECT * FROM `company_credentials` WHERE `id` = ?";
        $result = $this->db->query($query, [$companyId])->row();

        return $result; // This will return the company details or null if not found
    }

    // In your controller method that loads the form
    public function editCompanyProfile($companyId)
    {
        $companyDetails = $this->getCompanyDetails($companyId);

        // Pass the company details to the view
        $data['company'] = $companyDetails; // This will be null if no details are found

        // Load the view with the data
        $this->load->view('edit_company_profile', $data);
    }
    public function upload_logo()
    {
        header('Content-Type: application/json');

        // Get the absolute server path
        $base_path = str_replace('\\', '/', FCPATH); // Normalize to forward slashes

        // Define relative and absolute paths
        $relative_path = 'uploads/company_logos/';
        $absolute_path = $base_path . $relative_path;

        // Create directory if it doesn't exist
        if (!file_exists($absolute_path)) {
            if (!mkdir($absolute_path, 0777, true)) {
                echo json_encode([
                    'success' => false,
                    'error' => 'Failed to create directory',
                    'path_used' => $absolute_path
                ]);
                return;
            }
        }

        // Verify the path is writable
        if (!is_writable($absolute_path)) {
            echo json_encode([
                'success' => false,
                'error' => 'Directory exists but is not writable',
                'path_used' => $absolute_path
            ]);
            return;
        }

        // Configure upload
        $config = [
            'upload_path' => $absolute_path,
            'allowed_types' => 'jpg|jpeg|png|gif',
            'max_size' => 2048,
            'encrypt_name' => true,
            'remove_spaces' => true
        ];

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('croppedImage')) {
            $upload_data = $this->upload->data();
            echo json_encode([
                'success' => true,
                'file_path' => $relative_path . $upload_data['file_name']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => $this->upload->display_errors(),
                'debug_info' => [
                    'absolute_path' => $absolute_path,
                    'relative_path' => $relative_path,
                    'directory_exists' => file_exists($absolute_path),
                    'is_writable' => is_writable($absolute_path),
                    'free_space' => disk_free_space($base_path)
                ]
            ]);
        }
    }
}
