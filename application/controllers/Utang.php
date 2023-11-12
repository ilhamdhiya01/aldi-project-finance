<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utang extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
		if(!$this->session->userdata('loginStatus')) {
			redirect('login');
		}
    $this->load->model('Utang_model');
    $this->load->model('Authentication_model');
    $this->load->helper('custom_helper');
  }

	public function index()
	{
    $data = [
      'status' => $this->Utang_model->status()
    ];
    // echo json_encode($this->Utang_model->receivables());
    // exit();
		$this->load->view('layout/header');
		$this->load->view('layout/navbar');
		$this->load->view('layout/sidebar');
		$this->load->view('utang/index');
		$this->load->view('layout/footer');
	}

  public function showDebt() 
  {
    try {
      $debt = $this->Utang_model->debt();
      echo json_encode($debt);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function showCicilan() 
  {
    $referenceNumber = $_GET['referenceNumber'];
    try {
      $cicilan = $this->Utang_model->cicilan($referenceNumber);
      echo json_encode($cicilan);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function addUtang()
  {
    try {
      $response = $this->Utang_model->store($_POST);
      echo json_encode($response);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function addCicilan()
  {
    try {
      $response = $this->Utang_model->storeCicilan($_POST);
      echo json_encode($response);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function updateUtang()
  {
    try {
      $response = $this->Utang_model->update();
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }

  public function utangDetail()
  {
    try {
      $referenceNumber = $_GET['referenceNumber'];
      $response = $this->Utang_model->detail($referenceNumber);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }

  public function deleteUtang()
  {
    try {
      $referenceNumber = $_GET['referenceNumber'];
      $response = $this->Utang_model->destroy($referenceNumber);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }

  public function deleteCicilan()
  {
    try {
      $id = $_GET['id'];
      $referenceNumber = $_GET['referenceNumber'];
      $response = $this->Utang_model->destroyCicilan($id, $referenceNumber);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }
}


