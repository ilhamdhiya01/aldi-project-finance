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
      $query = "select a.referenceNumber, a.debtorName, a.recordDate, a.totalReceivable as cicilan
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
      $query = "select referenceNumber, debtorName from piutang where referenceNumber = '$referenceNumber'";
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