<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserConfiguration extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
		if(!$this->session->userdata('loginStatus')) {
			redirect('login');
		}
    $this->load->model('UserConfiguration_model');
    $this->load->model('Authentication_model');
  }

	public function index()
	{
    $data = [
      'roles' => $this->UserConfiguration_model->roles(),
      'status' => $this->UserConfiguration_model->status()
    ];
		$this->load->view('layout/header');
		$this->load->view('layout/navbar');
		$this->load->view('layout/sidebar');
		$this->load->view('userConfiguration/index', $data);
		$this->load->view('layout/footer');
	}

  public function showUser() 
  {
    try {
      $users = $this->UserConfiguration_model->users();
      echo json_encode($users);
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function addUser()
  {
    try {
      $inputValidation = [
        'required' => $this->validateInputRequired($_POST),
        'minLengthPassword' => $this->validateMinLengthPassword($_POST['password']),
        'uniqueUsername' => $this->validateUniqueEmail($_POST['username'])
      ];

      if(is_null($inputValidation['required']) && is_null($inputValidation['minLengthPassword']) && is_null($inputValidation['uniqueUsername'])) {
        $response = $this->UserConfiguration_model->store($_POST);
        echo json_encode($response);
      } else {
        echo json_encode($inputValidation);
      }
    } catch (\Throwable $th) {
      echo json_encode($th);
    }
  }

  public function validateInputRequired($request) {
    if(strlen($request['name']) == 0){
      return ['name' => 'Name must be filled in'];
    }
    if(strlen($request['username']) == 0){
      return ['username' => 'Username must be filled in'];
    }
    if(strlen($request['password']) == 0){
      return ['password' => 'Password must be filled in'];
    }
    if(strlen($request['role']) == 0){
      return ['role' => 'Role must be filled in'];
    }
    if(strlen($request['status']) == 0){
      return ['status' => 'Status must be filled in'];
    }
  }

  public function validateMinLengthPassword($request) {
    if(strlen($request) <= 8) {
      return 'Password must be at least 8 characters';
    }
  }

  public function validateUniqueEmail($username) {
    $user = $this->Authentication_model->checkUser($username);
    if(!is_null($user)) {
      return 'Username already exist';
    }
  }
}

