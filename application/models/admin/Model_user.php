<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model 
{

	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_user'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function show() {
        $sql = "SELECT
                id,
                full_name,
                email,
                photo,
                phone,
                role,
                status
                FROM tbl_user
                ORDER BY id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    function add($data) {
        $this->db->insert('tbl_user',$data);
        return $this->db->insert_id();
    }

    function update($id,$data) {
        $this->db->where('id',$id);
        $this->db->update('tbl_user',$data);
    }

    function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('tbl_user');
    }

    function getData($id)
    {
        $sql = 'SELECT * FROM tbl_user WHERE id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }

    function get_role()
    {
        return array("Admin","User");
    }
    
    function user_check($id)
    {
        $sql = 'SELECT * FROM tbl_user WHERE id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }
   
}
