<?php
class UserConfiguration_model extends CI_Model
{
    public function roles()
    {
      $query = "select optStatus, optCode
          from  tbloption
          where optDesc = 'RoleUser'";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function status()
    {
      $query = "select optStatus, optCode
          from  tbloption
          where optDesc = 'UserStatus'";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function activeUser() {
      $query = "select *
          from  users where status = '01'";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function users() {
      $query = "select a.name, a.username, b.optStatus as userStatus, c.optStatus as roleUser
          from  users a
          inner join tbloption b on b.optDesc = 'UserStatus' and a.status = b.optCode
          inner join tbloption c on c.optDesc = 'RoleUser' and a.roleId = c.optCode ";
      if($this->session->userdata('roleUser') == 'Admin') {
        $username = $this->session->userdata('username');
        $query .=  "where username = '$username'";
      } 
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function store($request) {
      $name = $request['name'];
      $username = $request['username'];
      $password = password_hash($request['password'], PASSWORD_DEFAULT);
      $status = $request['status'];
      $role = $request['role'];
      $createDt = date('YmdHis');

      $query = "insert into users (name, username, password, status, roleId, createDt) values ('$name', '$username', '$password', '$status', '$role', '$createDt')";
      $response = $this->db->query($query);
      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Create user has been successfully'
        ];
      }
    }

    public function detail($username)
    {
      $query = "select name, username, status, roleId from users where username = '$username'";
      $data = $this->db->query($query);
      return $data->row_array();
    }

    public function destroy($username) 
    {
      $query = "delete from users where username = '$username'";
      $response = $this->db->query($query);
      if($response) {
        return [
          'status' => 'success',
          'message' => $username . ' has been deleted'
        ];
      }
    }

    public function update() 
    {
      $name = $_POST['name'];
      $username = $_POST['username'];
      $usernameSession = $this->session->userdata('username');
      $userStatusSession = $this->session->userdata('userStatus') == 'Active' ? '01' : '02';
      $currentUsername = $_POST['currentUsername'];
      $status = $_POST['status'];
      $role = $_POST['role'];
      $updateDt = date('YmdHis');

      $query = "update users 
          set name = '$name', username = '$username', status = '$status', roleId = '$role', updateDt = '$updateDt' 
          where username = '$currentUsername'";
      $response = $this->db->query($query);

      if($usernameSession === $currentUsername) {
        $newUserData = [
          'name' => $name,
          'username' => $username,
          'userStatus' => $status == '01' ? 'Active' : 'Unactive',
          'roleUser' => $role,
          'loginStatus' => ($usernameSession === $username) && ($userStatusSession === $status),
        ];
        $this->session->set_userdata($newUserData);
      }

      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Data user has been updated'
        ];
      }
    }
}