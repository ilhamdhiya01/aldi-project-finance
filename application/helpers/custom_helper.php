<?php
function validateInputRequired($request) {
  if(isset($request['name'])) {
    if(strlen($request['name']) == 0){
      return ['name' => 'name','message' => 'Name must be filled in'];
    }
  }
  if(isset($request['username'])) {
    if(strlen($request['username']) == 0){
      return ['name' => 'username','message' => 'Username must be filled in'];
    }
  }
  if(isset($request['password'])) {
    if(strlen($request['password']) == 0){
      return ['name' => 'password','message' => 'Password must be filled in'];
    }
  }
  if(isset($request['role'])) {
    if(strlen($request['role']) == 0){
      return ['name' => 'role','message' => 'Role must be filled in'];
    }
  }
  if(isset($request['status'])) {
    if(strlen($request['status']) == 0){
      return ['name' => 'status','message' => 'Status must be filled in'];
    }
  }
  if(isset($request['phone'])) {
    if(strlen($request['phone']) == 0){
      return ['name' => 'phone','message' => 'Phone must be filled in'];
    }
  }
  if(isset($request['address'])) {
    if(strlen($request['address']) == 0){
      return ['name' => 'address','message' => 'Address must be filled in'];
    }
  }
}

function validateMinLengthPassword($request) {
  if(strlen($request) <= 8) {
    return 'Password must be at least 8 characters';
  }
}

function validateUniqueEmail($username, $user) {
  if(!is_null($user)) {
    return 'Username already exist';
  }
}

?>