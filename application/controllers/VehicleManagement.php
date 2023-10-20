<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VehicleManagement extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
		if(!$this->session->userdata('loginStatus')) {
			redirect('login');
		}
		$this->load->model('VehicleManagement_model');
		$this->load->model('UserConfiguration_model');
    $this->load->helper('custom_helper');
  }

	public function index()
	{
		$data = [
      'status' => $this->VehicleManagement_model->status()
    ];
		$this->load->view('layout/header');
		$this->load->view('layout/navbar');
		$this->load->view('layout/sidebar');
		$this->load->view('vehicleManagement/index', $data);
		$this->load->view('layout/footer');
	}

	public function showVehicle() 
  {
    try {
      $vehicles = $this->VehicleManagement_model->vehicles();
      echo json_encode($vehicles);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

	public function addVehicle()
  {
    try {
      $inputValidation = [
        'required' => validateInputRequired($_POST),
      ];
      if(is_null($inputValidation['required'])) {
        $response = $this->VehicleManagement_model->store();
        echo json_encode($response);
      } else {
        echo json_encode($inputValidation);
      }
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

	public function vehicleDetail()
  {
    try {
      $id = $_GET['id'];
      $response = $this->VehicleManagement_model->detail($id);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }

	public function updateVehicle()
  {
    try {
      // echo json_encode($_POST);
      // exit();
      $inputValidation = [
        'required' => validateInputRequired($_POST)
      ];
      if(is_null($inputValidation['required'])) {
        $response = $this->VehicleManagement_model->update();
        echo json_encode($response);
      } else {
        echo json_encode($inputValidation);
      }
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }

	public function deleteVehicle()
  {
    try {
      $id = $_GET['vehicleId'];
      $response = $this->VehicleManagement_model->destroy($id);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }


}
