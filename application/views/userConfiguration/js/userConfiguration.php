<script>
  $(document).ready(function() {
    showUsers();
  });

  const showUsers = () => {
    $('#listUser').html('');
    $.ajax({
      url: '<?= base_url('userconfiguration/showUser') ?>',
      type: 'GET',
      success: function(data) {
        const users = JSON.parse(data);

        if(users.length == 0) {
          $('#listUser').append(`
            <div class="card p-3 d-flex flex-md-row justify-content-between text-sm">
              <div class="d-flex justify-content-center align-items-center w-100" style="height: 150px;">
                <h4>No data yet</h4>
              </div>
            </div>
          `);
          return;
        }

        users.map((user) => {
          $('#listUser').append(`
            <div class="card p-3 d-flex flex-md-row align-items-center">
              <div class="row w-100">
                <div class="col-md-3 d-flex flex-md-column">
                  <span class=" font-weight-light">Nama</span>
                  <span class="">${user.name}</span>
                </div>
                <div class="col-md-3 d-flex flex-md-column">
                  <span class=" font-weight-light">Username</span>
                  <span class="">${user.username}</span>
                </div>
                <div class="col-md-3 d-flex flex-md-column">
                  <span class=" font-weight-light">Role</span>
                  <span class="">${user.roleUser}</span>
                </div>
                <div class="col-3 d-flex flex-md-column">
                  <span class=" font-weight-light">Status</span>
                  <span style="width: 80px;" class="badge ${user.userStatus == 'Active' ? 'badge-success' : 'badge-danger'} badge-success">${user.userStatus}</span>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <button onclick="handleDetailUser(\``+user.username+`\`)" data-toggle="modal" data-target="#modalUpdateUser" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Detail</button>
              </div>
            </div>
          `);
        })
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
        role: $('#roleEdit').val()
      },
      success: function(data) {
        $('#button-update-user').prop('disabled', false);
        console.log(data);
        return;
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