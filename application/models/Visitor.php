<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	public function fetchRecords(){
		
        $this->db->order_by("id", "desc");
		$query = $this->db->get('visitors');
		$data['visitors_data'] = $query->result();
		return $data;
	}
	public function saveRecord($data){
		$this->db->insert('visitors', $data);
		return $this->db->affected_rows();
	}
	public function editRecord($id){
		$query = $this->db->get_where('visitors', array('id'=>$id));
		return $query->row();
	}
	public function updateRecord($data){
		$this->db->where('id',$data['id']);
		return $this->db->update('visitors', $data);
	}

	public function deleteData($id){
		$this->db->where('id', $id);
		return $this->db->delete('visitors');
	}
}
