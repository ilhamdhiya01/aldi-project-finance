<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CashOut extends CI_Controller {
  
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
		$this->load->view('cashout/index');
		$this->load->view('layout/footer');
	}

  public function showCashOut() 
  {
    try {
      $cashOut = $this->Finance_model->cashOut();
      echo json_encode($cashOut);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function addCashOut()
  {
    try {
      $response = $this->Finance_model->storeCashOut($_POST);
      echo json_encode($response);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function updateCashOut()
  {
    try {
      $response = $this->Finance_model->updateCashOut();
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }

  public function cashOutDetail()
  {
    try {
      $id = $_GET['id'];
      $response = $this->Finance_model->detailCashOut($id);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }
}


