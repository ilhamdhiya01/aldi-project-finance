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
    $this->load->helper('custom_helper');
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
      $user = $this->Authentication_model->checkUser($_POST['username']);
      $inputValidation = [
        'required' => validateInputRequired($_POST),
        'minLengthPassword' => validateMinLengthPassword($_POST['password']),
        'uniqueUsername' => validateUniqueEmail($_POST['username'],  $user)
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

  public function updateUser()
  {
    try {
      $inputValidation = [
        'required' => validateInputRequired($_POST)
      ];
      if(is_null($inputValidation['required'])) {
        $response = $this->UserConfiguration_model->update();
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
      $response = $this->UserConfiguration_model->detail($username);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }

  public function deleteUser()
  {
    try {
      $username = $_GET['username'];
      $response = $this->UserConfiguration_model->destroy($username);
      echo json_encode($response);
    } catch (\Throwable $th) {
      throw new Exception($th);
    }
  }
}


