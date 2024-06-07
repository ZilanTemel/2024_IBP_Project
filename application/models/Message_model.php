<?php
/*class Message_model extends CI_Model {
    public function sendMessage($data) {
        $this->db->insert('messages', $data);
    }

    public function getMessages($user_id) {
        $this->db->where('receiver_id', $user_id);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('messages');
        return $query->result_array();
    }

    public function markAsRead($message_id) {
        $this->db->set('is_read', TRUE);
        $this->db->where('id', $message_id);
        $this->db->update('messages');
    }
}
*/




class Message_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function send_message($data) {
        // Hata ayıklama için gönderilen verileri yazdır
        log_message('debug', 'Sending message: ' . print_r($data, true));
        
        // Veritabanına ekleme işlemi
        $result = $this->db->insert('messages', $data);
        
        // Hata ayıklama için sorguyu yazdır
        log_message('debug', 'SQL Query: ' . $this->db->last_query());

        return $result;
    }

    public function get_messages($user_id) {
        $this->db->where('receiver_id', $user_id);
        $query = $this->db->get('messages');
        return $query->result_array();
    }

    public function mark_as_read($message_id) {
        $this->db->where('id', $message_id);
        return $this->db->update('messages', array('is_read' => TRUE));
    }
}


?>


