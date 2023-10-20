<?php
class VehicleManagement_model extends CI_Model
{
    public function vehicles() {
      $query = "select a.id, a.type, a.numberPlate, b.optStatus as vehicleStatus, b.optCode, a.lastService, a.serviceAgain
          from  vehicles a
          inner join tbloption b on b.optDesc = 'VehicleStatus' and a.status = b.optCode";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function store() {
      $type = $_POST['type'];
      $numberPlate = $_POST['numberPlate'];
      $lastService = $_POST['lastService'];
      $serviceAgain = $_POST['serviceAgain'];
      $status = $_POST['status'];

      $query = "insert into vehicles (type, numberPlate, lastService, serviceAgain, status) values ('$type', '$numberPlate', '$lastService', '$serviceAgain','$status')";
      $response = $this->db->query($query);
      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Create vehicle has been successfully'
        ];
      }
    }

    public function detail($id)
    {
      $query = "select id, type, numberPlate, lastService, serviceAgain, status from vehicles where id = '$id'";
      $data = $this->db->query($query);
      return $data->row_array();
    }

    public function destroy($id) 
    {
      $query = "delete from vehicles where id = '$id'";
      $response = $this->db->query($query);
      if($response) {
        return [
          'status' => 'success',
          'message' => 'Vehicle has been deleted'
        ];
      }
    }

    public function update() 
    {
      $vehicleId = $_POST['vehicleId'];
      $type = $_POST['type'];
      $numberPlate = $_POST['numberPlate'];
      $lastService = $_POST['lastService'];
      $serviceAgain = $_POST['serviceAgain'];
      $status = $_POST['status'];

      $query = "update vehicles 
          set type = '$type', numberPlate = '$numberPlate', lastService = '$lastService', serviceAgain = '$serviceAgain', status = '$status' 
          where id = '$vehicleId'";
      $response = $this->db->query($query);

      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Vehicle has been updated'
        ];
      }
    }

    public function status()
    {
      $query = "select optStatus, optCode
          from  tbloption
          where optDesc = 'VehicleStatus'";
      $data = $this->db->query($query);
      return $data->result_array();
    }
}