<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Message_model');
    }

    // Mesaj gönderme fonksiyonu
    public function send() {
        $data = array(
            'sender_id' => $this->session->userdata('user_id'),  // Gönderen kullanıcının ID'si
            'receiver_id' => $this->input->post('receiver_id'),  // Alıcı kullanıcının ID'si
            'subject' => $this->input->post('subject'),          // Mesajın konusu
            'message' => $this->input->post('message'),          // Mesajın içeriği
            'created_at' => date('Y-m-d H:i:s')                  // Mesajın gönderildiği tarih
        );
        
        $this->Message_model->sendMessage($data);
        $this->session->set_flashdata('message', 'Mesaj başarıyla gönderildi');
        redirect('messages/inbox');
    }

    // Mesajları görüntüleme fonksiyonu
    public function inbox() {
        $data['messages'] = $this->Message_model->getMessages($this->session->userdata('user_id'));
        $this->load->view('messages/inbox', $data);
    }

    // Mesajı okundu olarak işaretleme fonksiyonu
    public function markAsRead($id) {
        $this->Message_model->markAsRead($id);
        $this->session->set_flashdata('message', 'Mesaj okundu olarak işaretlendi');
        redirect('messages/inbox');
    }
}
?>