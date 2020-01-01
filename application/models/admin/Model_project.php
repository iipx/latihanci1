<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_project extends CI_Model 
{

	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_project'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function show() {
        $sql = "SELECT
                id,
                name,
                description,
                start,
                end,
                status,
                owner
                FROM tbl_project
                ORDER BY id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    function add($data) {
        $this->db->insert('tbl_project',$data);
        return $this->db->insert_id();
    }

    function update($id,$data) {
        $this->db->where('id',$id);
        $this->db->update('tbl_project',$data);
    }

    function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('tbl_project');
    }

    function getData($id)
    {
        $sql = 'SELECT * FROM tbl_project WHERE id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }

    function get_role()
    {
        return array("Admin","User");
    }
    
    function user_check($id)
    {
        $sql = 'SELECT * FROM tbl_project WHERE id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }
   
}
