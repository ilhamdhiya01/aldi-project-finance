<script>
  $(document).ready(function() {
    showVehicle();
  });

  const showVehicle = () => {
    $('#listVehicle').html('');
    $.ajax({
      url: '<?= base_url('vehiclemanagement/showVehicle') ?>',
      type: 'GET',
      success: function(data) {
        try {
          const vehicles = JSON.parse(data);
          if(vehicles.length == 0) {
            $('#listVehicle').append(`
              <div class="card p-3 d-flex flex-md-row justify-content-between text-sm">
                <div class="d-flex justify-content-center align-items-center w-100" style="height: 150px;">
                  <h4>No data yet</h4>
                </div>
              </div>
            `);
            return;
          }

          vehicles.map((vehicle) => {
            $('#listVehicle').append(`
              <div class="card p-3 d-flex flex-md-row align-items-center text-sm">
                <div class="row w-100">
                  <div class="col-md-3 d-flex flex-md-column">
                    <span class=" font-weight-light">Type Kendaraan</span>
                    <span class="">${vehicle.type}</span>
                  </div>
                  <div class="col-md-2 d-flex flex-md-column">
                    <span class=" font-weight-light">Plat Nomor</span>
                    <span class="">${vehicle.numberPlate}</span>
                  </div>
                  <div class="col-md-2 d-flex flex-md-column">
                    <span class=" font-weight-light">Service Terakhir</span>
                    <span class="">${vehicle.lastService}</span>
                  </div>
                  <div class="col-md-2 d-flex flex-md-column">
                    <span class=" font-weight-light">Service Kembali</span>
                    <span class="">${vehicle.serviceAgain}</span>
                  </div>
                  <div class="col-3 d-flex flex-md-column">
                    <span class=" font-weight-light">Status Kendaraan</span>
                    <span style="width: 100px;" class="badge ${vehicle.optCode == '01' ? 'badge-success' : vehicle.optCode == '02' ? 'badge-danger' : 'badge-warning'}">${vehicle.vehicleStatus}</span>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <button onclick="handleDetailVehicle(\``+vehicle.id+`\`)" data-toggle="modal" data-target="#modalUpdateVehicle" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Detail</button>
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

  const handleAddVehicle = (e) => {
    e.preventDefault();
    $('#button-add-vehicle').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('vehiclemanagement/addVehicle') ?>',
      type: 'POST',
      data: {
        type: $('#typeAdd').val(),
        numberPlate: $('#numberPlateAdd').val(),
        lastService: $('#lastServiceAdd').val(),
        serviceAgain: $('#serviceAgainAdd').val(),
        status: $('#statusAdd').val()
      },
      success: function(data) {
        $('#button-add-vehicle').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.required != null || response.required != undefined) {
          toastr.error(response.required.message);
        }

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showVehicle();
          $('#modalAddVehicle').modal('hide');
        }
      }
    })
  }

  const handleDetailVehicle = (id) => {
    // change button
    $('#button-edit-vehicle').removeClass('d-none');
    $('#button-update-vehicle').addClass('d-none');
    $('#button-delete-vehicle').removeClass('d-none');
    $('#button-cancel').addClass('d-none');
    // unreadonlu
    $('#typeEdit').prop('readonly', true);
    $('#numberPlateEdit').prop('readonly', true);
    $('#lastServiceEdit').prop('disabled', true);
    $('#serviceAgainEdit').prop('disabled', true);
    $('#statusEdit').prop('disabled', true);

    $.ajax({
      url: '<?= base_url('vehiclemanagement/vehicleDetail') ?>',
      type: 'GET',
      data: {
        id: id
      },
      success: function(data) {
        console.log(data) ;
        // return;
        const {id,type, numberPlate, lastService, serviceAgain, status} = JSON.parse(data);
        $('#vehicleId').val(id);
        $('#typeEdit').val(type);
        $('#numberPlateEdit').val(numberPlate);
        $('#lastServiceEdit').val(lastService);
        $('#serviceAgainEdit').val(serviceAgain);
        $('#statusEdit').val(status);
      }
    })
  }

  const handleUpdateVehicle = (e) => {
    e.preventDefault();
    $('#button-update-vehicle').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('vehiclemanagement/updateVehicle') ?>',
      type: 'POST',
      data: {
        type: $('#typeEdit').val(),
        numberPlate: $('#numberPlateEdit').val(),
        lastService: $('#lastServiceEdit').val(),
        serviceAgain: $('#serviceAgainEdit').val(),
        status: $('#statusEdit').val(),
        vehicleId: $('#vehicleId').val()
      },
      success: function(data) {
        $('#button-update-vehicle').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.required != null || response.required != undefined) {
          toastr.error(response.required.message);
        }

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showVehicle();
          $('#modalUpdateVehicle').modal('hide');
        }
      }
    })
  }

  const handleDeletelVehicle = (id) => {
    $.ajax({
      url: '<?= base_url('vehiclemanagement/deleteVehicle') ?>',
      type: 'GET',
      data: {
        vehicleId: id
      },
      success: function(data) {
        const {status, message} = JSON.parse(data);
        if(status == 'success') {
          toastr.success(message);
          showVehicle();
          $('#modalUpdateVehicle').modal('hide');
        }
      }
    })
  }

  const handleButtonFormDetail = (type) => {
    switch (type) {
      case 'edit':
        // change button
        $('#button-edit-vehicle').addClass('d-none');
        $('#button-update-vehicle').removeClass('d-none');
        $('#button-delete-vehicle').addClass('d-none');
        $('#button-cancel').removeClass('d-none');
        // unreadonlu
        $('#typeEdit').prop('readonly', false);
        $('#numberPlateEdit').prop('readonly', false);
        $('#lastServiceEdit').prop('disabled', false);
        $('#serviceAgainEdit').prop('disabled', false);
        $('#statusEdit').prop('disabled', false);
        break;
      case 'delete':
        const id = $('#vehicleId').val();
        const confirmDelete = confirm(`Hapus data ini`) ;
        if(confirmDelete) {
          handleDeletelVehicle(id);
        }
        break;
      default:
        // change button
        $('#button-edit-vehicle').removeClass('d-none');
        $('#button-update-vehicle').addClass('d-none');
        $('#button-delete-vehicle').removeClass('d-none');
        $('#button-cancel').addClass('d-none');
        // unreadonlu
        $('#typeEdit').prop('readonly', true);
        $('#numberPlateEdit').prop('readonly', true);
        $('#lastServiceEdit').prop('disabled', true);
        $('#serviceAgainEdit').prop('disabled', true);
        $('#statusEdit').prop('disabled', true);
        break;
    }
  }
</script>