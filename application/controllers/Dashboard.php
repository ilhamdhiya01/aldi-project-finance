<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
		if(!$this->session->userdata('loginStatus')) {
			redirect('login');
		}

		$this->load->model('Finance_model');
		$this->load->model('UserConfiguration_model');
		$this->load->model('VendorManagement_model');
		$this->load->model('VehicleManagement_model');
  }

	public function index()
	{
		$data = [
			'totalUserActive' => $this->UserConfiguration_model->activeUser(),
			'totalVendorActive' => $this->VendorManagement_model->activeVendor(),
			'totalVehicleActive' => $this->VehicleManagement_model->activeVehicle()
		];
		$this->load->view('layout/header');
		$this->load->view('layout/navbar');
		$this->load->view('layout/sidebar');
		$this->load->view('dashboard/index', $data);
		$this->load->view('layout/footer');
	}

	public function totalRevenue() {
		try {
			$revenue = $this->Finance_model->totalRevenue();
			echo json_encode($revenue);
		} catch (\Throwable $th) {
			echo json_encode($th);
		}
	}

	public function totalExpenditure() {
		try {
			$expenditure = $this->Finance_model->totalExpenditure();
			echo json_encode($expenditure);
		} catch (\Throwable $th) {
			echo json_encode($th);
		}
	}
}
