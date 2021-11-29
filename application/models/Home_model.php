<?php

class Home_model extends CI_Model {
    function get_list_buku() {
        $query = $this->db->query("SELECT * FROM list_buku");

        return $query->result_array();
    }

    function check_user($values) {
        $query = $this->db->query("SELECT * FROM user WHERE password = ?", $values);

        return $query->result_array();
    }

    function get_buku($values) {
        $query = $this->db->query("SELECT * FROM list_buku WHERE id_buku = ?", $values);

        return $query->result_array();
    }

    function add_buku($values)
    {
        $this->db->insert('list_buku', $values);
    }

    function update_buku($values)
    {
        $this->db->trans_begin();
        $this->db->where('id_buku', $values['id_buku']);
        $this->db->update('list_buku', $values);
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
    }

    function delete_buku($id_buku) {
        $query = $this->db->query("DELETE FROM list_buku WHERE id_buku = ?", $id_buku);
    }
}