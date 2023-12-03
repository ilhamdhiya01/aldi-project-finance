<?php
class VendorManagement_model extends CI_Model
{

    public function activeVendor() 
    {
      $query = "select *
      from  vendors where vendorStatus = '01'";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function vendors() {
      $query = "select a.id, a.name, a.phone, b.optStatus as vendorStatus, a.address
          from  vendors a
          inner join tbloption b on b.optDesc = 'UserStatus' and a.vendorStatus = b.optCode";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function store() {
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $status = $_POST['status'];

      $query = "insert into vendors (name, phone, address, vendorStatus) values ('$name', '$phone', '$address', '$status')";
      $response = $this->db->query($query);
      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Create vendor has been successfully'
        ];
      }
    }

    public function detail($id)
    {
      $query = "select id, name, phone, address, vendorStatus from vendors where id = '$id'";
      $data = $this->db->query($query);
      return $data->row_array();
    }

    public function destroy($id) 
    {
      $query = "delete from vendors where id = '$id'";
      $response = $this->db->query($query);
      if($response) {
        return [
          'status' => 'success',
          'message' => 'Vendor has been deleted'
        ];
      }
    }

    public function update() 
    {
      $vendorId = $_POST['vendorId'];
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $status = $_POST['status'];
      $address = $_POST['address'];

      $query = "update vendors 
          set name = '$name', phone = '$phone', address = '$address', vendorStatus = '$status' 
          where id = '$vendorId'";
      $response = $this->db->query($query);

      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Vendor has been updated'
        ];
      }
    }
}