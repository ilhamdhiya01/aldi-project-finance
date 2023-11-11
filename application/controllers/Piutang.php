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
    // echo json_encode($this->Piutang_model->receivables());
    // exit();
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

  public function showCicilan() 
  {
    $referenceNumber = $_GET['referenceNumber'];
    try {
      $cicilan = $this->Piutang_model->cicilan($referenceNumber);
      echo json_encode($cicilan);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function addPiutang()
  {
    try {
      $response = $this->Piutang_model->store($_POST);
      echo json_encode($response);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function addCicilan()
  {
    try {
      $response = $this->Piutang_model->storeCicilan($_POST);
      echo json_encode($response);
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

  public function piutangDetail()
  {
    try {
      $referenceNumber = $_GET['referenceNumber'];
      $response = $this->Piutang_model->detail($referenceNumber);
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


