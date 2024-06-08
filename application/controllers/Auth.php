<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('fileUser');
        $this->load->model('Message_model'); // Message_model'i yükleyin
       
    }

    public function index() {
        $this->load->view('Auth/login');
    }

    public function register() {
        $this->load->view('Auth/register');
    }

    public function file() {
        $this->load->model('file');
    }

    public function searchAdmin() {
        $searchTerm = $this->input->post('search');
        $data['files'] = $this->file->searchFiles($searchTerm);
        $this->load->view('Auth/adminPage', $data);
    }

    public function deleteFile($id) {
        $fileData = $this->file->getRows($id);
        
        if (!empty($fileData)) {
            $filePath = 'uploads/files/'.$fileData['file_name'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $delete = $this->file->delete($id);

            if ($delete) {
                $this->session->set_flashdata('success', 'File deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Some problem occurred, please try again.');
            }
        } else {
            $this->session->set_flashdata('error', 'File not found.');
        }

        redirect('Auth/adminPage');
    }

    public function adminPage() {
        $data = array();
        $errorUploadType = $statusMsg = '';
        if ($this->input->post('fileSubmit')) {
            if (!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0) {
                $filesCount = count($_FILES['files']['name']);
                $titles = explode(',', $this->input->post('titles'));
                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                    $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                    $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                    $uploadPath = 'uploads/files/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) {
                        $fileData = $this->upload->data();
                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                        $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                        $uploadData[$i]['title'] = isset($titles[$i]) ? trim($titles[$i]) : '';
                    } else {
                        $errorUploadType .= $_FILES['file']['name'].' | ';
                    }
                }
                $errorUploadType = !empty($errorUploadType) ? '<br/> File Type Error: '.trim($errorUploadType, ' | ') : '';
                if (!empty($uploadData)) {
                    $insert = $this->file->insert($uploadData);
                    $statusMsg = $insert ? 'Files uploaded successfully.' . $errorUploadType : 'Some problem occurred, please try again.';
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file." . $errorUploadType;
                }
            } else {
                $statusMsg = "Please select a file to upload.";
            }
        }
        $data['files'] = $this->file->getRows();
        $data['statusMsg'] = $statusMsg;

        $data['messages'] = $this->Message_model->get_messages_with_users();
     
        $this->load->view('Auth/adminPage', $data);
    }

    public function userManagement() {
        $data['users'] = $this->auth_model->getAllUsersByRole('user');
        $this->load->view('Auth/userManagement', $data);
    }

    public function deleteUser($id) {
        if ($this->auth_model->deleteUser($id)) {
            $this->session->set_flashdata('success', 'User deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Some problem occurred, please try again.');
        }
        redirect('Auth/userManagement');
    }

    public function editUser($id) {
        $user = $this->auth_model->getUserById($id);
        if (!empty($user)) {
            $data['user'] = $user;
            $this->load->view('Auth/editUser', $data);
        } else {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('Auth/userManagement');
        }
    }

    public function updateUser() {
        $id = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email')
        );
        $user = $this->auth_model->getUserById($id);
        $data['user_type'] = $user['user_type'];

        if ($this->auth_model->update_user($id, $data)) {
            $this->session->set_flashdata('success', 'User updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Some problems occurred, please try again.');
        }
        redirect('Auth/userManagement');
    }

    public function userPage() {
        $data['files'] = $this->fileUser->getRows(); // fileUser modelini kullanın
        $this->load->view('Auth/userPage', $data);
    }

    public function search() {
        $keyword = $this->input->post('search');
        $data['files'] = $this->fileUser->searchFiles($keyword); // fileUser modelini kullanın
        $this->load->view('Auth/userPage', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('Auth/');
    }

    public function registration_form() {
        $this->auth_model->register_user();
    }

    public function login_form() {
        $this->auth_model->login_user();
    }


     
    
    //message 
    public function sendMessage() {
        $sender_id = $this->session->userdata('user_id');
        
        if ($sender_id === NULL) {
            $this->session->set_flashdata('error', 'You must be logged in to send a message.');
            redirect('Auth/userPage');
            return;
        }
    
        $data = array(
            'sender_id' => $sender_id, 
            'receiver_id' => $this->input->post('receiver_id'), 
            'message' => $this->input->post('message'),
            'created_at' => date('Y-m-d H:i:s') 
        );
    
        // Hata ayıklama için gönderilen verileri yazdır
        log_message('debug', 'Message data: ' . print_r($data, true));
    
        if ($this->Message_model->send_message($data)) {
            $this->session->set_flashdata('success', 'Message sent successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to send message.');
        }
        redirect('Auth/userPage');
    }
}
    
?>