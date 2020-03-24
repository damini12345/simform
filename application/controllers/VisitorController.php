<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VisitorController extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('visitor');
	}
	public function index(){
		$this->load->view('visitor_data');
	}
	public function fetchData(){
		
		$data = $this->visitor->fetchRecords();
		echo json_encode($data);
	}
	public function saveData(){
		$form_data = json_decode(file_get_contents("php://input"));
		$data = array(
			'first_name' => $form_data->first_name,
			'last_name' => $form_data->last_name,
			'email' => $form_data->email,
			'date_of_birth' => $form_data->dob,
			'random_number' => $form_data->random_number
		);
		if($form_data->action == 'Insert'){
			$result = $this->visitor->saveRecord($data);
			if($result == 1){
				$response['success'] = true;
				$response['message'] = "Data Inserted Successfully!";
			}else{
				$response['success'] = false;
				$response['message'] = "Error in Data Insertion";
			}
		}
		if($form_data->action == 'Edit'){
			$data['id'] = $form_data->id;
			$result = $this->visitor->updateRecord($data);
			if($result == 1){
				$response['success'] = true;
				$response['message'] = "Data Updated Successfully!";
			}else{
				$response['success'] = false;
				$response['message'] = "Error in Data Updation";
			}
		}
		echo json_encode($response);
	}

	public function editData(){
		$form_data = json_decode(file_get_contents("php://input"));
		$result = $this->visitor->editRecord($form_data->id);
		echo json_encode($result);
	}

	public function deleteData(){
		$form_data = json_decode(file_get_contents("php://input"));
		$result = $this->visitor->deleteData($form_data->id);
		if($result == 1){
			$response['success'] = true;
			$response['message'] = "Data Deleted Successfully!";
		}else{
			$response['success'] = false;
			$response['message'] = "Error in Data Deletion";
		}
		echo json_encode($response);
	}
}
