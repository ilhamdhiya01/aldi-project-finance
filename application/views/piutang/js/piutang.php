<script>
  $(document).ready(function() {
    showReceivables();
  });

  const showReceivables = () => {
    $('#listReceivables').html('');
    $.ajax({
      url: '<?= base_url('piutang/showReceivables') ?>',
      type: 'GET',
      success: function(data) {
        console.log(data)
        try {
          const receivables = JSON.parse(data);
          if(receivables.length == 0) {
            $('#listReceivables').append(`
              <div class="card p-3 d-flex flex-md-row justify-content-between text-sm">
                <div class="d-flex justify-content-center align-items-center w-100" style="height: 150px;">
                  <h4>No data yet</h4>
                </div>
              </div>
            `);
            return;
          }

          receivables.map((receivable) => {
            $('#listReceivables').append(`
              <div class="card p-3 d-flex flex-md-row align-items-center">
                <div class="row w-100">
                  <div class="col-md-2 d-flex flex-md-column text-sm">
                    <span class=" font-weight-light">Nomor Referensi</span>
                    <span class="">${receivable.referenceNumber}</span>
                  </div>
                  <div class="col-md-2 d-flex flex-md-column text-sm">
                    <span class=" font-weight-light">Debitur</span>
                    <span class="">${receivable.debtorName}</span>
                  </div>
                  <div class="col-md-2 d-flex flex-md-column text-sm">
                    <span class=" font-weight-light">Tanggal Pencatatan</span>
                    <span class="">${receivable.recordDate}</span>
                  </div>
                  <div class="col-md-2 d-flex flex-md-column text-sm">
                    <span class=" font-weight-light">Tanggal Jatuh Tempo</span>
                    <span class="">${receivable.dueDate}</span>
                  </div>
                  <div class="col-md-2 d-flex flex-md-column text-sm">
                    <span class=" font-weight-light">Piutang Awal</span>
                    <span class="">${receivable.piutangAwal}</span>
                  </div>
                  <div class="col-2 d-flex flex-md-column">
                    <span class=" font-weight-light">Status</span>
                    <span style="width: 80px;" class="badge ${receivable.status == 'Jatuh tempo' ? 'badge-warning' : receivable.status == 'Sudah terbayar' ? 'badge-success' : 'badge-danger'}">${receivable.status}</span>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <button onclick="handleDetailUser(\``+receivable.referenceNumber+`\`)" data-toggle="modal" data-target="#modalUpdateUser" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Detail</button>
                </div>
              </div>
            `);
          });
        } catch (error) {
          console.log(error);
        }
      }
    })
  }

  const handleAddUser = (e) => {
    e.preventDefault();
    $('#button-add-user').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('userconfiguration/addUser') ?>',
      type: 'POST',
      data: {
        name: $('#nameAdd').val(),
        username: $('#usernameAdd').val(),
        password: $('#passwordAdd').val(),
        status: $('#statusAdd').val(),
        role: $('#roleAdd').val()
      },
      success: function(data) {
        $('#button-add-user').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.required != null || response.required != undefined) {
          toastr.error(response.required.message);
        }

        if(response.minLengthPassword != null || response.minLengthPassword != undefined) {
          toastr.error(response.minLengthPassword);
        }

        if(response.uniqueUsername != null || response.uniqueUsername != undefined) {
          toastr.error(response.uniqueUsername);
        }

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showUsers();
          $('#modalAddUser').modal('hide');
        }
      }
    })
  }

  const handleDetailUser = (username) => {
    // change button
    $('#button-edit-user').removeClass('d-none');
    $('#button-update-user').addClass('d-none');
    $('#button-delete-user').removeClass('d-none');
    $('#button-cancel').addClass('d-none');
    // unreadonlu
    $('#nameEdit').prop('readonly', true);
    $('#usernameEdit').prop('readonly', true);
    $('#statusEdit').prop('disabled', true);
    $('#roleEdit').prop('disabled', true);

    $.ajax({
      url: '<?= base_url('userconfiguration/userDetail') ?>',
      type: 'GET',
      data: {
        username: username
      },
      success: function(data) {
        const {name, username, status, roleId} = JSON.parse(data);
        $('#nameEdit').val(name);
        $('#usernameEdit').val(username);
        $('#statusEdit').val(status);
        $('#roleEdit').val(roleId);
        $('#username').val(username);
      }
    })
  }

  const handleUpdateUser = (e) => {
    e.preventDefault();
    $('#button-update-user').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('userconfiguration/updateUser') ?>',
      type: 'POST',
      data: {
        name: $('#nameEdit').val(),
        username: $('#usernameEdit').val(),
        password: $('#passwordEdit').val(),
        status: $('#statusEdit').val(),
        role: $('#roleEdit').val(),
        currentUsername: $('#username').val(),
        currentStatus: $('#status').val(),
      },
      success: function(data) {
        $('#button-update-user').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.required != null || response.required != undefined) {
          toastr.error(response.required.message);
        }

        if(response.minLengthPassword != null || response.minLengthPassword != undefined) {
          toastr.error(response.minLengthPassword);
        }

        if(response.uniqueUsername != null || response.uniqueUsername != undefined) {
          toastr.error(response.uniqueUsername);
        }

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showUsers();
          $('#modalUpdateUser').modal('hide');
        }
      }
    })
  }

  const handleDeletelUser = (username) => {
    $.ajax({
      url: '<?= base_url('userconfiguration/deleteUser') ?>',
      type: 'GET',
      data: {
        username: username
      },
      success: function(data) {
        const {status, message} = JSON.parse(data);
        if(status == 'success') {
          toastr.success(message);
          showUsers();
          $('#modalUpdateUser').modal('hide');
        }
      }
    })
  }

  const handleButtonFormDetail = (type) => {
    switch (type) {
      case 'edit':
        // change button
        $('#button-edit-user').addClass('d-none');
        $('#button-update-user').removeClass('d-none');
        $('#button-delete-user').addClass('d-none');
        $('#button-cancel').removeClass('d-none');
        // unreadonlu
        $('#nameEdit').prop('readonly', false);
        $('#usernameEdit').prop('readonly', false);
        $('#statusEdit').prop('disabled', false);
        $('#roleEdit').prop('disabled', false);
        break;
      case 'delete':
        const username = $('#usernameEdit').val();
        const confirmDelete = confirm(`Hapus data ini ${username}`) ;
        if(confirmDelete) {
          handleDeletelUser(username);
        }
        break;
      default:
        // change button
        $('#button-edit-user').removeClass('d-none');
        $('#button-update-user').addClass('d-none');
        $('#button-delete-user').removeClass('d-none');
        $('#button-cancel').addClass('d-none');
        // unreadonlu
        $('#nameEdit').prop('readonly', true);
        $('#usernameEdit').prop('readonly', true);
        $('#statusEdit').prop('disabled', true);
        $('#roleEdit').prop('disabled', true);
        break;
    }
  }
</script>