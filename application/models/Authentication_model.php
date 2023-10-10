<?php
class Authentication_model extends CI_Model
{
    public function checkUser($username) {
      $query = "select a.name, a.username, a.password, b.optStatus as userStatus, c.optStatus as roleUser
          from  users a
          inner join tbloption b on b.optDesc = 'UserStatus' and a.status = b.optCode
          inner join tbloption c on c.optDesc = 'RoleUser' and a.roleId = c.optCode
          where username = '$username'";
      $data = $this->db->query($query);
      return $data->row_array();
    }
}