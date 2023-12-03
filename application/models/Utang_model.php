<?php
class Utang_model extends CI_Model
{
    public function status()
    {
      $query = "select optStatus, optCode
          from  tbloption
          where optDesc = 'utangStatus'";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function debt() {
      $query = "select a.referenceNumber, a.creditorName, a.recordDate, a.lastPaymentDate, a.currentDebt as utangAwal, a.initialDebt, sum(a.totalDebt) as total
          from  utang a
          group by a.referenceNumber";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function cicilan($referenceNumber) {
      $query = "select a.id, a.referenceNumber, a.creditorName, a.recordDate, a.totalDebt as cicilan
          from  utang a where a.referenceNumber = '$referenceNumber' and a.initialDebt is null";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function store($request) {
      $referenceNumber = $request['referenceNumber'];
      $creditorName = $request['creditorName'];
      $recordDate = $request['recordDate'];
      $dueDate = $request['dueDate'];
      $initialDebt = $request['initialDebt'];
      $createDt = date('YmdHis');

      $query = "insert into utang (referenceNumber, creditorName, recordDate, dueDate, currentDebt, initialDebt, createdDate) values ('$referenceNumber', '$creditorName', '$recordDate', '$dueDate', $initialDebt, $initialDebt, '$createDt' )";
      $response = $this->db->query($query);
      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Create utang has been successfully'
        ];
      }
    }
    public function storeCicilan($request) {
      $referenceNumber = $request['referenceNumber'];
      $creditorName = $request['creditorName'];
      $recordDate = $request['recordDate'];
      $totalDebt = $request['totalDebt'];
      $createDt = date('YmdHis');

      $query1 = "insert into utang (referenceNumber, creditorName, recordDate, totalDebt, createdDate) values ('$referenceNumber', '$creditorName', '$recordDate', $totalDebt, '$createDt' )";
      $response = $this->db->query($query1);

      $query2 = "update utang 
        set currentDebt = (select currentDebt from utang where referenceNumber = '$referenceNumber' and currentDebt is not null) - $totalDebt, lastPaymentDate = '$recordDate', updatedDate = '$recordDate'
        where referenceNumber = '$referenceNumber' and currentDebt is not null";
      $this->db->query($query2);

      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Create cicilan has been successfully'
        ];
      }
    }

    public function detail($referenceNumber)
    {
      $query = "select referenceNumber, creditorName, recordDate, dueDate, initialDebt from utang where referenceNumber = '$referenceNumber' and currentDebt is not null";
      $data = $this->db->query($query);
      return $data->row_array();
    }

    public function destroy($referenceNumber) 
    {
      $query = "delete from utang where referenceNumber = '$referenceNumber'";
      $response = $this->db->query($query);
      if($response) {
        return [
          'status' => 'success',
          'message' => 'utang data has been deleted'
        ];
      }
    }

    public function destroyCicilan($id, $referenceNumber) 
    {
      $query2 = "update utang 
          set currentDebt = (select currentDebt from utang where referenceNumber = '$referenceNumber' and currentDebt is not null) + (select totalDebt from utang where id = '$id') 
          where referenceNumber = '$referenceNumber' and currentDebt is not null";
      $this->db->query($query2);

      $query1 = "delete from utang where id = '$id'";
      $response = $this->db->query($query1);

      if($response) {
        return [
          'status' => 'success',
          'message' => 'Cicilan has been deleted'
        ];
      }
    }

    public function update() 
    {
      $referenceNumber = $_POST['referenceNumber'];
      $creditorName = $_POST['creditorName'];
      $recordDate = $_POST['recordDate'];
      $dueDate = $_POST['dueDate'];
      $initialDebt = $_POST['initialDebt'];
      $updateDt = date('YmdHis');

      $query = "update utang 
          set referenceNumber = '$referenceNumber', creditorName = '$creditorName', recordDate = '$recordDate', dueDate = '$dueDate', initialDebt = $initialDebt, updatedDate = ' $updateDt' 
          where referenceNumber = '$referenceNumber' and currentDebt is not null";
      $response = $this->db->query($query);

      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Data utang has been updated'
        ];
      }
    }
}