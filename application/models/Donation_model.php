<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donation_model extends CI_Model {

	public function get_donations() {
		$q = $this->db->select('ngoId, ngoName, SUM(amount) as amount');
		$q = $this->db->group_by('ngoId'); 
		$q = $this->db->order_by('ngoId', 'asc'); 
		$q = $this->db->get('donation', 10);
		/*
		$q = $this->db->select('ngoId, SUM(amount) AS amount');
		$q = $this->db->get_where('donation');
		$q = $this->db->group_by("ngoId");
		*/
		return $q->result();
	}
	public function insert($data) {
		$this->db->insert('donation',$data);
		return $this->db->insert_id();
	}
	public function update($data,$id) {
		$this->db->where('id',$id);
		$this->db->update('donation',$data);
	}
	public function find_donation($id) {
		$q = $this->db->get_where('donation',array('id'=>$id));
		return $q->row(0);
	}

}