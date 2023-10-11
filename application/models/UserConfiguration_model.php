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

    public function users() {
      $query = "select a.name, a.username, b.optStatus as userStatus, c.optStatus as roleUser
          from  users a
          inner join tbloption b on b.optDesc = 'UserStatus' and a.status = b.optCode
          inner join tbloption c on c.optDesc = 'RoleUser' and a.roleId = c.optCode";
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

      // $query = "insert into users (name, username, password, status, roleId, createDt) values ('$name', '$username', '$password', '$status', '$role', '$createDt')";
      // $response = $this->db->query($query);
      // if($response) {
      // }
      return [
        'code' => 200,
        'status' => 'success',
        'message' => 'Create user has been successfully'
      ];
    }

}