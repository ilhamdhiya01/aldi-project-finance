<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VendorManagement extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
		if(!$this->session->userdata('loginStatus')) {
			redirect('login');
		}
		$this->load->model('VendorManagement_model');
		$this->load->model('UserConfiguration_model');
    $this->load->helper('custom_helper');
  }

	public function index()
	{
		$data = [
      'status' => $this->UserConfiguration_model->status()
    ];
		$this->load->view('layout/header');
		$this->load->view('layout/navbar');
		$this->load->view('layout/sidebar');
		$this->load->view('vendorManagement/index', $data);
		$this->load->view('layout/footer');
	}

	public function showVendor() 
  {
    try {
      $vendors = $this->VendorManagement_model->vendors();
      echo json_encode($vendors);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

	public function addVendor()
  {
    try {
      $inputValidation = [
        'required' => validateInputRequired($_POST),
      ];
      if(is_null($inputValidation['required'])) {
        $response = $this->VendorManagement_model->store();
        echo json_encode($response);
      } else {
        echo json_encode($inputValidation);
      }
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

	public function vendorDetail()
  {
    try {
      $id = $_GET['id'];
      $response = $this->VendorManagement_model->detail($id);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }

	public function updateVendor()
  {
    try {
      $inputValidation = [
        'required' => validateInputRequired($_POST)
      ];
      if(is_null($inputValidation['required'])) {
        $response = $this->VendorManagement_model->update();
        echo json_encode($response);
      } else {
        echo json_encode($inputValidation);
      }
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }

	public function deleteVendor()
  {
    try {
      $id = $_GET['vendorId'];
      $response = $this->VendorManagement_model->destroy($id);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }


}
