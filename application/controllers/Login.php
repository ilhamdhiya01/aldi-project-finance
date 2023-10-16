<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    if($this->session->userdata('loginStatus')) {
			redirect('dashboard');
		}
    $this->load->model('Authentication_model');
  }

	public function index()
	{
		$this->load->view('auth/index');
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

    if(!password_verify($password, $user['password'])) {
      $response = [
        'loginStatus' => false,
        'message' => 'Password yang anda masukan salah',
      ];
      echo json_encode($response);
      exit();
    }

    if($user['userStatus'] == 'Unactive') {
      $response = [
        'loginStatus' => false,
        'message' => 'Akun tidak aktif',
      ];
      echo json_encode($response);
      exit();
    }

    if($user['username'] == $username && password_verify($password, $user['password'])) {
      $userData = [
        'name' => $user['name'],
        'username' => $user['username'],
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
}
