<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexController extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Donation_model');
		//$this->load->model('Ngo_model');
	}

	public function index() {
		$data['title'] = "NGOs Donations - by Ignacio Giampaoli";
		$data['donations'] = $this->Donation_model->get_donations();
		$this->load->view('index', $data);
	}

	public function insert() {
		/*
		if (!$this->input->is_ajax_request()) {
			exit('not allowed');
			return false;
		}
		*/
		$donationAmount = array('amount'=>$this->input->post('amount'),'ngoId'=>$this->input->post('ngoId'),'ngoName'=>$this->input->post('ngoName'));
		$insert_id = $this->Donation_model->insert($donationAmount);
		$this->find_donation($insert_id);
	}

	public function done() {
		if (!$this->input->is_ajax_request()) {
			exit('not allowed');
			return false;
		}
		$id = $this->input->post('id');
		$data = array(
					'status'	=> 1,
					'done_at'	=> date("Y-m-d H:i:s"),
				);
		$this->Donation_model->update($data,$id);
	}

	public function edit() {
		if (!$this->input->is_ajax_request()) {
			exit('not allowed');
			return false;
		}
		$id = $this->input->post('id');
		$donation = $this->Donation_model->find_donation($id);
		echo json_encode($donation);
	}

	public function update() {
		if (!$this->input->is_ajax_request()) {
			exit('not allowed');
			return false;
		}
		$id = $this->input->post('id');
		$data = array(
					'amount'	=> $this->input->post('donation'),
					'ngoId'	=> $this->input->post('ngoId'),
				);
		$this->Donation_model->update($data,$id);
		$this->find_donation($id);
	}

	public function find_donation($id) {
		$donation = $this->Donation_model->find_donation($id);
		echo json_encode($donation);
	}

	public function countDonations() {
		$donation = $this->Donation_model->get_donations();
		echo json_encode($donation);
	}

}
