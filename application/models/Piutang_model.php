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
      $query = "select a.referenceNumber, a.debtorName, a.recordDate, a.lastPaymentDate, a.currentReceivable as piutangAwal, a.initialReceivable, sum(a.totalReceivable) as total
          from  piutang a
          group by a.referenceNumber";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function cicilan($referenceNumber) {
      $query = "select a.id, a.referenceNumber, a.debtorName, a.recordDate, a.totalReceivable as cicilan
          from  piutang a where a.referenceNumber = '$referenceNumber' and a.initialReceivable is null";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function store($request) {
      $referenceNumber = $request['referenceNumber'];
      $debtorName = $request['debtorName'];
      $recordDate = $request['recordDate'];
      $dueDate = $request['dueDate'];
      $initialReceivable = $request['initialReceivable'];
      $createDt = date('YmdHis');

      $query = "insert into piutang (referenceNumber, debtorName, recordDate, dueDate, currentReceivable, initialReceivable, createdDate) values ('$referenceNumber', '$debtorName', '$recordDate', '$dueDate', $initialReceivable, $initialReceivable, '$createDt' )";
      $response = $this->db->query($query);
      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Create piutang has been successfully'
        ];
      }
    }
    public function storeCicilan($request) {
      $referenceNumber = $request['referenceNumber'];
      $debtorName = $request['debtorName'];
      $recordDate = $request['recordDate'];
      $totalReceivable = $request['totalReceivable'];
      $createDt = date('YmdHis');

      $query1 = "insert into piutang (referenceNumber, debtorName, recordDate, totalReceivable, createdDate) values ('$referenceNumber', '$debtorName', '$recordDate', $totalReceivable, '$createDt' )";
      $response = $this->db->query($query1);

      $query2 = "update piutang 
        set currentReceivable = (select currentReceivable from piutang where referenceNumber = '$referenceNumber' and currentReceivable is not null) - $totalReceivable, lastPaymentDate = '$recordDate', updatedDate = '$recordDate'
        where referenceNumber = '$referenceNumber' and currentReceivable is not null";
      $this->db->query($query2);

      $query3 = "insert into finance (information, recordDate, cashIn, createdDate) values ('Cicilan piutang dari $debtorName', '$recordDate',  $totalReceivable, '$createDt')";
      $this->db->query($query3);

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
      $query = "select referenceNumber, debtorName, recordDate, dueDate, initialReceivable from piutang where referenceNumber = '$referenceNumber' and currentReceivable is not null";
      $data = $this->db->query($query);
      return $data->row_array();
    }

    public function destroy($referenceNumber) 
    {
      $query = "delete from piutang where referenceNumber = '$referenceNumber'";
      $response = $this->db->query($query);
      if($response) {
        return [
          'status' => 'success',
          'message' => 'Piutang data has been deleted'
        ];
      }
    }

    public function destroyCicilan($id, $referenceNumber) 
    {
      $query2 = "update piutang 
          set currentReceivable = (select currentReceivable from piutang where referenceNumber = '$referenceNumber' and currentReceivable is not null) + (select totalReceivable from piutang where id = '$id') 
          where referenceNumber = '$referenceNumber' and currentReceivable is not null";
      $this->db->query($query2);

      $query1 = "delete from piutang where id = '$id'";
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
      $debtorName = $_POST['debtorName'];
      $recordDate = $_POST['recordDate'];
      $dueDate = $_POST['dueDate'];
      $initialReceivable = $_POST['initialReceivable'];
      $updateDt = date('YmdHis');

      $query = "update piutang 
          set referenceNumber = '$referenceNumber', debtorName = '$debtorName', recordDate = '$recordDate', dueDate = '$dueDate', initialReceivable = $initialReceivable, updatedDate = ' $updateDt' 
          where referenceNumber = '$referenceNumber' and currentReceivable is not null";
      $response = $this->db->query($query);

      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Data piutang has been updated'
        ];
      }
    }
}