<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CashIn extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
		if(!$this->session->userdata('loginStatus')) {
			redirect('login');
		}
    $this->load->model('Finance_model');
    $this->load->model('Authentication_model');
    $this->load->helper('custom_helper');
  }

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/navbar');
		$this->load->view('layout/sidebar');
		$this->load->view('cashin/index');
		$this->load->view('layout/footer');
	}

  public function showCashIn() 
  {
    try {
      $cashIn = $this->Finance_model->cashIn();
      echo json_encode($cashIn);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function addCashIn()
  {
    try {
      $response = $this->Finance_model->store($_POST);
      echo json_encode($response);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function updateCashIn()
  {
    try {
      $response = $this->Finance_model->update();
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }

  public function CashInDetail()
  {
    try {
      $id = $_GET['id'];
      $response = $this->Finance_model->detail($id);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }

  public function deleteCashIn()
  {
    try {
      $id = $_GET['id'];
      $response = $this->Finance_model->destroy($id);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }
}


