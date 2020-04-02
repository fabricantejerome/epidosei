<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // User
    public function add($params)
    {
        $this->db->trans_start();
        $this->db->insert('users', $params);
        $this->db->trans_complete();

        return $this->db->insert_id();
    }

    public function read($params)
    {
        $fields = array(
            "id",
            "firstname",
            "surname",
            "CONCAT(firstname, ' ', mi, ' ', surname) AS fullname",
            "username",
            "email",
            "file_name"
        );

        $query = $this->db->select($fields)
                ->from('users')
                ->where($params)
                ->get();

        return $query->row_array();
    }
}