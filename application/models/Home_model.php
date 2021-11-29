<?php

class Home_model extends CI_Model {
    // User
    function check_user($values) {
        $this->db->where('email', $values['email']);
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function get_list_user() {
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function add_user($value) {
        $this->db->insert('user', $value);
    }

    public function delete_user($value) {
        $this->db->where('id_user', $value);
        $this->db->delete('user');
    }

    public function update_user($value) {
        $this->db->where('id_user', $value['id_user']);
        $this->db->update('user', $value);
    }

    // Book
    function get_list_book() {
        $query = $this->db->query("SELECT * FROM list_book");

        return $query->result_array();
    }

    function get_book($values) {
        $query = $this->db->query("SELECT * FROM list_book WHERE id_book = ?", $values);

        return $query->result_array();
    }

    function add_book($values) {
        $this->db->insert('list_book', $values);
    }

    function update_book($values) {
        $this->db->trans_begin();
        $this->db->where('id_book', $values['id_book']);
        $this->db->update('list_book', $values);
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
    }

    function delete_book($id_book) {
        $query = $this->db->query("DELETE FROM list_book WHERE id_book = ?", $id_book);
    }

    // Request
    function get_list_request() {
        $query = $this->db->get('request');
        return $query->result_array();
    }

    public function insert_request($value) {
        $this->db->trans_begin();
        $this->db->insert('request', $value);
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
    }

    public function approve_request($value) {
        $this->db->set('status', 'Y');
        $this->db->where('id_request', $value);
        $this->db->update('request');
    }

    public function reject_request($value) {
        $this->db->set('status', 'N');
        $this->db->where('id_request', $value);
        $this->db->update('request');
    }

    public function get_book_request($value) {
        $this->db->where('id_book', $value);
        $this->db->order_by('id_book', 'ASC');
        $this->db->get('request');
    }
}