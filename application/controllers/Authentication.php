<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    if($this->session->userdata('loginStatus')) {
			redirect('dashboard');
		}
    $this->load->model('Authentication_model');
  }

	public function login()
	{
		$this->load->view('auth/login');
	}

  public function loginProcess()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $this->Authentication_model->checkUser($username);

    if(is_null($user)) {
      $response = [
        'loginStatus' => false,
        'message' => 'Username belum terdaftar',
      ];
      echo json_encode($response);
      exit();
    }

    if($user['password'] != $password) {
      $response = [
        'loginStatus' => false,
        'message' => 'Password yang anda masukan salah',
      ];
      echo json_encode($response);
      exit();
    }

    if($user['username'] == $username && $user['password'] == $password) {
      // set session
      $userData = [
        'name' => $user['name'],
        'userStatus' => $user['userStatus'],
        'roleUser' => $user['roleUser'],
        'loginStatus' => true
      ];
      $this->session->set_userdata($userData);

      $response = [
        'loginStatus' => true,
        'message' => 'Login success',
      ];
      echo json_encode($response);
    }
  }

  public function logoutProcess()
  {
    $this->session->sess_destroy();
    redirect('authentication/login');
  }
}
