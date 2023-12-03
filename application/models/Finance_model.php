<?php
class Finance_model extends CI_Model
{
    
    public function totalRevenue() {
      $query = "select a.cashIn
          from  finance a where cashIn";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function totalExpenditure() {
      $query = "select a.cashOut
          from  finance a where cashOut";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function cashIn() {
      $query = "select a.id, a.information, a.recordDate, a.cashIn
          from  finance a where cashIn order by id desc";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function cashOut() {
      $query = "select a.id, a.information, a.recordDate, a.cashOut
          from  finance a where cashOut order by id desc";
      $data = $this->db->query($query);
      return $data->result_array();
    }

    public function storeCashOut($request) {
      $information = $request['information'];
      $recordDate = $request['recordDate'];
      $cashOut = $request['cashOut'];
      $createDt = date('YmdHis');

      $query = "insert into finance (information, recordDate, cashOut, createdDate) values ('$information', '$recordDate', $cashOut, '$createDt' )";
      $response = $this->db->query($query);
      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Create cashout has been successfully'
        ];
      }
    }

    public function store($request) {
      $information = $request['information'];
      $recordDate = $request['recordDate'];
      $cashIn = $request['cashIn'];
      $createDt = date('YmdHis');

      $query = "insert into finance (information, recordDate, cashIn, createdDate) values ('$information', '$recordDate', $cashIn, '$createDt' )";
      $response = $this->db->query($query);
      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Create cashin has been successfully'
        ];
      }
    }

    public function detail($id)
    {
      $query = "select id, information, recordDate, cashIn from finance where id = '$id'";
      $data = $this->db->query($query);
      return $data->row_array();
    }

    public function detailCashOut($id)
    {
      $query = "select id, information, recordDate, cashOut from finance where id = '$id'";
      $data = $this->db->query($query);
      return $data->row_array();
    }

    public function destroy($id) 
    {
      $query = "delete from finance where id = '$id'";
      $response = $this->db->query($query);
      if($response) {
        return [
          'status' => 'success',
          'message' => 'Cashin data has been deleted'
        ];
      }
    }

    public function update() 
    {
      $id = $_POST['id'];
      $information = $_POST['information'];
      $recordDate = $_POST['recordDate'];
      $cashIn = $_POST['cashIn'];
      $updateDt = date('YmdHis');

      $query = "update finance 
          set information = '$information', recordDate = '$recordDate', cashIn = '$cashIn', updatedDate = ' $updateDt' 
          where id = '$id'";
      $response = $this->db->query($query);

      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Data cashin has been updated'
        ];
      }
    }

    public function updateCashOut() 
    {
      $id = $_POST['id'];
      $information = $_POST['information'];
      $recordDate = $_POST['recordDate'];
      $cashOut = $_POST['cashOut'];
      $updateDt = date('YmdHis');

      $query = "update finance 
          set information = '$information', recordDate = '$recordDate', cashOut = '$cashOut', updatedDate = ' $updateDt' 
          where id = '$id'";
      $response = $this->db->query($query);

      if($response) {
        return [
          'code' => 200,
          'status' => 'success',
          'message' => 'Data cashout has been updated'
        ];
      }
    }
}