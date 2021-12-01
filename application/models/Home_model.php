<?php

class Home_model extends CI_Model {
    // User
    function check_user($values) {
        $query = $this->db->query("SELECT * FROM user WHERE email = ? AND password = ?", $values);
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
        $this->db->delete('request');
        $this->db->where('id_user', $value);
        $this->db->delete('user');
    }

    public function update_user($value) {
        $this->db->where('id_user', $value['id_user']);
        $this->db->update('user', $value);
    }

    public function get_user($id_user)
    {
        $query = $this->db->where('id_user', $id_user)->get('user');
        return $query->result_array();
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
        $this->db->where('id_book', $id_book);
        $this->db->delete('request');
        $query = $this->db->query("DELETE FROM list_book WHERE id_book = ?", $id_book);
    }

    // Request
    function get_list_request() {
        $this->db->select('id_request, name, title, start_time, end_time');
        $this->db->join('user', 'user.id_user = request.id_user');
        $this->db->join('list_book', 'list_book.id_book = request.id_book');
        $query = $this->db->get('request');
        return $query->result_array();
    }

    public function get_unapproved_request()
    {
        $this->db->select('id_request, name, title, start_time, end_time');
        $this->db->join('user', 'user.id_user = request.id_user');
        $this->db->join('list_book', 'list_book.id_book = request.id_book');
        $this->db->where('status', '2');
        $query = $this->db->get('request');
        return $query->result_array();
    }

    public function get_user_request($id_user)
    {
        $this->db->select('id_request, name, title, start_time, end_time, status');
        $this->db->join('user', 'user.id_user = request.id_user');
        $this->db->join('list_book', 'list_book.id_book = request.id_book');
        $this->db->where('user.id_user', $id_user);
        $query = $this->db->get('request');
        return $query->result_array();
    }

    public function insert_request($value) {
        $id = $value['id_book'];
        $start = $this->db->escape($value['start_time']);
        $end = $this->db->escape($value['end_time']);
        $day_taken = $this->db->query("SELECT day_taken($id, $start, $end) state")->row_array();
        if ($day_taken['state']) {
            return false;
        } else {
            $this->db->insert('request', $value);
            return true;
        }
    }

    public function approve_request($value) {
        $this->db->set('status', '1');
        $this->db->where('id_request', $value);
        $this->db->update('request');
    }

    public function reject_request($value) {
        $this->db->set('status', '0');
        $this->db->where('id_request', $value);
        $this->db->update('request');
    }

    public function get_book_request($value) {
        $where = [
            'id_book' => $value,
            'status' => 1
        ];
        $query = $this->db->query("SELECT start_time, end_time FROM request WHERE id_book = ? AND status = ? ORDER BY 1", $where);
        return $query->result_array();
    }

    public function get_unapprove_book_request($values)
    {
        $where = [
            'id_book' => $values['id_book'],
            'status' => 2,
            'id_user' => $values['id_user']
        ];
        $query = $this->db->query("SELECT start_time, end_time FROM request WHERE id_book = ? AND status = ? ORDER BY 1", $where);
        return $query->result_array();
    }

    public function delete_request($id_request)
    {
        $this->db->where('id_request', $id_request);
        $this->db->delete('request');
    }
}