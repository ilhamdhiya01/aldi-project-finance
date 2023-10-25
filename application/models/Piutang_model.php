<?php
class Piutang_model extends CI_Model
{
    public function status()
    {
      $query = "select optStatus, optCode
          from  tbloption
          where optDesc = 'PiutangStatus'";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function receivables() {
      $query = "select a.referenceNumber, a.debtorName, a.recordDate, a.dueDate, a.initialReceivable as piutangAwal, b.optStatus as status
          from  piutang a
          inner join tbloption b on b.optDesc = 'PiutangStatus' and a.piutangStatus = b.optCode";
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