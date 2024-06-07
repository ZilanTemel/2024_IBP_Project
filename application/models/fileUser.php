<?php
class fileUser extends CI_Model {

    public $tableName;

    function __construct() {
        parent::__construct();
        $this->tableName = 'files';
    }

    public function getRows() {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchFiles($keyword) {
        if (!empty($keyword)) {
            $this->db->select('id, file_name, uploaded_on, title');
            $this->db->from($this->tableName);
            $this->db->like('file_name', $keyword);
            $this->db->or_like('title', $keyword);
            $query = $this->db->get();
            return $query->result_array();
        } else {
            return array(); // Arama terimi boş ise boş sonuç döndür
        }
    }
}
?>
