<script>
  $(document).ready(function() {
    showVendor();
  });

  const showVendor = () => {
    $('#listVendor').html('');
    $.ajax({
      url: '<?= base_url('vendormanagement/showVendor') ?>',
      type: 'GET',
      success: function(data) {
        try {
          const vendors = JSON.parse(data);
          if(vendors.length == 0) {
            $('#listUser').append(`
              <div class="card p-3 d-flex flex-md-row justify-content-between text-sm">
                <div class="d-flex justify-content-center align-items-center w-100" style="height: 150px;">
                  <h4>No data yet</h4>
                </div>
              </div>
            `);
            return;
          }

          vendors.map((vendor) => {
            $('#listVendor').append(`
              <div class="card p-3 d-flex flex-md-row align-items-center text-sm">
                <div class="row w-100">
                  <div class="col-md-3 d-flex flex-md-column">
                    <span class=" font-weight-light">Nama</span>
                    <span class="">${vendor.name}</span>
                  </div>
                  <div class="col-md-3 d-flex flex-md-column">
                    <span class=" font-weight-light">Telepon</span>
                    <span class="">${vendor.phone}</span>
                  </div>
                  <div class="col-md-3 d-flex flex-md-column">
                    <span class=" font-weight-light">Alamat</span>
                    <span class="">${vendor.address}</span>
                  </div>
                  <div class="col-3 d-flex flex-md-column">
                    <span class=" font-weight-light">Status</span>
                    <span style="width: 80px;" class="badge ${vendor.vendorStatus == 'Active' ? 'badge-success' : 'badge-danger'} badge-success">${vendor.vendorStatus}</span>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <button onclick="handleDetailVendor(\``+vendor.id+`\`)" data-toggle="modal" data-target="#modalUpdateVendor" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Detail</button>
                </div>
              </div>
            `);
          });
        } catch (error) {
          // window.location.href = '<?= base_url('logout') ?>';
        }
      }
    })
  }

  const handleAddVendor = (e) => {
    e.preventDefault();
    $('#button-add-vendor').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('vendormanagement/addVendor') ?>',
      type: 'POST',
      data: {
        name: $('#nameAdd').val(),
        phone: $('#phoneAdd').val(),
        address: $('#addressAdd').val(),
        status: $('#statusAdd').val()
      },
      success: function(data) {
        $('#button-add-vendor').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.required != null || response.required != undefined) {
          toastr.error(response.required.message);
        }

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showVendor();
          $('#modalAddVendor').modal('hide');
        }
      }
    })
  }

  const handleDetailVendor = (id) => {
    // change button
    $('#button-edit-vendor').removeClass('d-none');
    $('#button-update-vendor').addClass('d-none');
    $('#button-delete-vendor').removeClass('d-none');
    $('#button-cancel').addClass('d-none');
    // unreadonlu
    $('#nameEdit').prop('readonly', true);
    $('#phoneEdit').prop('readonly', true);
    $('#addressEdit').prop('disabled', true);
    $('#statusEdit').prop('disabled', true);

    $.ajax({
      url: '<?= base_url('vendormanagement/vendorDetail') ?>',
      type: 'GET',
      data: {
        id: id
      },
      success: function(data) {
        console.log(data) ;
        // return;
        const {id,name, phone, vendorStatus, address} = JSON.parse(data);
        $('#vendorId').val(id);
        $('#nameEdit').val(name);
        $('#phoneEdit').val(phone);
        $('#addressEdit').val(address);
        $('#statusEdit').val(vendorStatus);
      }
    })
  }

  const handleUpdateVendor = (e) => {
    e.preventDefault();
    $('#button-update-vendor').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('vendormanagement/updateVendor') ?>',
      type: 'POST',
      data: {
        name: $('#nameEdit').val(),
        phone: $('#phoneEdit').val(),
        address: $('#addressEdit').val(),
        status: $('#statusEdit').val(),
        vendorId: $('#vendorId').val()
      },
      success: function(data) {
        $('#button-update-vendor').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.required != null || response.required != undefined) {
          toastr.error(response.required.message);
        }

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showVendor();
          $('#modalUpdateVendor').modal('hide');
        }
      }
    })
  }

  const handleDeletelVendor = (id) => {
    $.ajax({
      url: '<?= base_url('vendormanagement/deleteVendor') ?>',
      type: 'GET',
      data: {
        vendorId: id
      },
      success: function(data) {
        const {status, message} = JSON.parse(data);
        if(status == 'success') {
          toastr.success(message);
          showVendor();
          $('#modalUpdateVendor').modal('hide');
        }
      }
    })
  }

  const handleButtonFormDetail = (type) => {
    switch (type) {
      case 'edit':
        // change button
        $('#button-edit-vendor').addClass('d-none');
        $('#button-update-vendor').removeClass('d-none');
        $('#button-delete-vendor').addClass('d-none');
        $('#button-cancel').removeClass('d-none');
        // unreadonlu
        $('#nameEdit').prop('readonly', false);
        $('#phoneEdit').prop('readonly', false);
        $('#statusEdit').prop('disabled', false);
        $('#addressEdit').prop('disabled', false);
        break;
      case 'delete':
        const id = $('#vendorId').val();
        const confirmDelete = confirm(`Hapus data ini`) ;
        if(confirmDelete) {
          handleDeletelVendor(id);
        }
        break;
      default:
        // change button
        $('#button-edit-vendor').removeClass('d-none');
        $('#button-update-vendor').addClass('d-none');
        $('#button-delete-vendor').removeClass('d-none');
        $('#button-cancel').addClass('d-none');
        // unreadonlu
        $('#nameEdit').prop('readonly', true);
        $('#phoneEdit').prop('readonly', true);
        $('#statusEdit').prop('disabled', true);
        $('#addressEdit').prop('disabled', true);
        break;
    }
  }
</script>