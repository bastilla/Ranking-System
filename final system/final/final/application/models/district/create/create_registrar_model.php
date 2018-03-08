<?php

class Create_Registrar_Model extends CI_Model
{
	function __construct()
    {
        parent:: __construct();
    }

    function get_school_name()
	{
		$this->db  ->select("school_id, school_name")
                    ->from('school');
        $query = $this->db->get();
        return $query->result_array();
	}

	function insert_user_account($data)
	{
		$this->db->insert('user', $data);
	}

	function insert_registrar_account($data)
	{
		$this->db->select_max('user_id');
        $query = $this->db->get('user');
        $id = $query->result();
        $ui = array();
        foreach($id as $row){
            $ui = array(
                'uid' => $row->user_id
            );
        }

        $this->db->set('user_id', $ui['uid']);
        $query = $this->db->insert('registrar', $data);
        return $this->db->insert_id();
	}
}