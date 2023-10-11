<script>
  $(document).ready(function() {
    // show user
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
            <div class="card p-3 d-flex flex-md-row justify-content-between">
              <div class="d-flex flex-md-column">
                <span class=" font-weight-light">Nama</span>
                <span class="">${user.name}</span>
              </div>
              <div class="d-flex flex-md-column">
                <span class=" font-weight-light">Username</span>
                <span class="">${user.username}</span>
              </div>
              <div class="d-flex flex-md-column">
                <span class=" font-weight-light">Role</span>
                <span class="">${user.roleUser}</span>
              </div>
              <div class="d-flex flex-lg-column">
                <span class=" font-weight-light">Status</span>
                <span class="badge ${user.userStatus == 'Active' ? 'badge-success' : 'badge-danger'} badge-success">${user.userStatus}</span>
              </div>
              <div class="d-flex align-items-center">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Detail</button>
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
        name: $('#name').val(),
        username: $('#username').val(),
        password: $('#password').val(),
        status: $('#status').val(),
        role: $('#role').val()
      },
      success: function(data) {
        const response = JSON.parse(data);
        console.log(response.uniqueUsername);
      }
    })
  }
</script>