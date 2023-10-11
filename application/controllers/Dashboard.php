<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
		if(!$this->session->userdata('loginStatus')) {
			redirect('login');
		}
  }

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/navbar');
		$this->load->view('layout/sidebar');
		$this->load->view('dashboard/index');
		$this->load->view('layout/footer');
	}
}
