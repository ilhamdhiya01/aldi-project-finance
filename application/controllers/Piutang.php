<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
		if(!$this->session->userdata('loginStatus')) {
			redirect('login');
		}
    $this->load->model('Piutang_model');
    $this->load->model('Authentication_model');
    $this->load->helper('custom_helper');
  }

	public function index()
	{
    $data = [
      'status' => $this->Piutang_model->status()
    ];
		$this->load->view('layout/header');
		$this->load->view('layout/navbar');
		$this->load->view('layout/sidebar');
		$this->load->view('piutang/index', $data);
		$this->load->view('layout/footer');
	}

  public function showReceivables() 
  {
    try {
      $receivables = $this->Piutang_model->receivables();
      echo json_encode($receivables);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function addUser()
  {
    try {
      $user = $this->Authentication_model->checkUser($_POST['username']);
      $inputValidation = [
        'required' => validateInputRequired($_POST),
        'minLengthPassword' => validateMinLengthPassword($_POST['password']),
        'uniqueUsername' => validateUniqueEmail($_POST['username'],  $user)
      ];

      if(is_null($inputValidation['required']) && is_null($inputValidation['minLengthPassword']) && is_null($inputValidation['uniqueUsername'])) {
        $response = $this->Piutang_model->store($_POST);
        echo json_encode($response);
      } else {
        echo json_encode($inputValidation);
      }
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function updateUser()
  {
    try {
      $inputValidation = [
        'required' => validateInputRequired($_POST)
      ];
      if(is_null($inputValidation['required'])) {
        $response = $this->Piutang_model->update();
        echo json_encode($response);
      } else {
        echo json_encode($inputValidation);
      }
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }

  public function userDetail()
  {
    try {
      $username = $_GET['username'];
      $response = $this->Piutang_model->detail($username);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }

  public function deleteUser()
  {
    try {
      $username = $_GET['username'];
      $response = $this->Piutang_model->destroy($username);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }
}


