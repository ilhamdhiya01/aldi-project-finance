<script>
  $(document).ready(function() {
    showReceivables();
  });

  const showCicilan = (referenceNumber) => {
    $('#recordCicilan').html('');
    $.ajax({
      url: '<?= base_url('piutang/showCicilan') ?>',
      data: {
        referenceNumber: referenceNumber != null ? referenceNumber : $('#referenceNumberDetail').val(),
      },
      type: 'GET',
      success: function(data) {
        try {
          const cicilan = JSON.parse(data);
          let totalArr = [];
          cicilan.map((item, index) => {
            totalArr.push(parseInt(item.cicilan));
            $('#recordCicilan').append(`
              <tr>
                <td>${index + 1}</td>
                <td>${item.referenceNumber}</td>
                <td>${item.debtorName}</td>
                <td>${item.recordDate}</td>
                <td>${formatRupiah(item.cicilan)}</td>
                <td></td>
              </tr>
            `);
          });
          const total = totalArr.reduce((total, element) => {
            return total + element;
          }, 0); 

          $('#totalCicilan').text(formatRupiah(total));
        } catch (error) {
          console.log(error);
        }
      }
    });
  }


  const showReceivables = () => {
    const today = new Date();

    // Mendapatkan tahun, bulan, dan tanggal
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');  // Bulan dimulai dari 0, sehingga ditambah 1
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;
    $('#listReceivables').html('');
    $.ajax({
      url: '<?= base_url('piutang/showReceivables') ?>',
      type: 'GET',
      success: function(data) {
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
                    <span class=" font-weight-light">Terakhir Dibayarkan</span>
                    <span class="">${receivable.lastPaymentDate}</span>
                  </div>
                  <div class="col-md-2 d-flex flex-md-column text-sm">
                    <span class=" font-weight-light">Piutang Awal</span>
                    <span class="">${formatRupiah(receivable.piutangAwal)}</span>
                  </div>
                  <div class="col-2 d-flex flex-md-column">
                    <span class=" font-weight-light">Status</span>
                    <span style="width: 90px;" class="badge ${receivable.lastPaymentDate == null ? 'badge-warning' : formattedDate > receivable.lastPaymentDate  ? 'badge-danger' : formattedDate >= receivable.lastPaymentDate  ? 'badge-warning' : 'badge-success'}">${receivable.lastPaymentDate == null || formattedDate == receivable.lastPaymentDate ? 'Jatuh tempo' : formattedDate > receivable.lastPaymentDate  ? 'Terlambat' : 'Sudah terbayar'}</span>
                  </div>
                </div>
                <div class="d-flex flex-row align-items-center" style="column-gap: 5px;">
                <button onclick="handleDetailPiutang(\``+receivable.referenceNumber+`\`, 'detail')" data-toggle="modal" data-target="#modalUpdatePiutang" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Detail</button>
                ${receivable.total != receivable.initialReceivable ? `<button onclick="handleDetailPiutang(\``+receivable.referenceNumber+`\`, 'cicilan')" data-toggle="modal" data-toggle="modal" data-target="#modal-lg" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Cicilan</button>` : '<span class="badge badge-success">Lunas</span>'}
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

  const handleAddPiutang = (e) => {
    e.preventDefault();
    $('#button-add-user').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('piutang/addPiutang') ?>',
      type: 'POST',
      data: {
        referenceNumber: $('#referenceNumberAdd').val(),
        debtorName: $('#debtorNameAdd').val(),
        recordDate: $('#recordDateAdd').val(),
        dueDate: $('#dueDateAdd').val(),
        initialReceivable: $('#initialReceivableAdd').val()
      },
      success: function(data) {
        $('#button-add-user').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showReceivables();
          $('#modalAddPiutang').modal('hide');
          $('#formAddPiutang')[0].reset();
        }
      }
    })
  }

  const handleAddCicilan = (e) => {
    e.preventDefault();
    $('#button-add-cicilan').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('piutang/addCicilan') ?>',
      type: 'POST',
      data: {
        referenceNumber: $('#referenceNumberDetail').val(),
        debtorName: $('#debtorNameDetail').val(),
        recordDate: $('#recordDateDetail').val(),
        totalReceivable: $('#totalReceivableDetail').val()
      },
      success: function(data) {
        $('#button-add-cicilan').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showCicilan();
          showReceivables();
          $('#modal-lg').modal('hide');
          $('#formAddCicilan')[0].reset();
        }
      }
    })
  }


  const handleDetailPiutang = (referenceNumber, type) => {
    if(type === 'detail') {
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
    }

    $.ajax({
      url: '<?= base_url('piutang/piutangDetail') ?>',
      type: 'GET',
      data: {
        referenceNumber: referenceNumber
      },
      success: function(data) {
        const {referenceNumber, debtorName} = JSON.parse(data);
        $('#referenceNumberDetail').val(referenceNumber);
        $('#debtorNameDetail').val(debtorName);
        showCicilan(referenceNumber);
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

  const generateReferenceNumber = () => {
    // const words = inputString.split(' ');
    // const initials = words.map(word => word.charAt(0)).join('');

    // Mendapatkan tanggal saat ini
    const currentDate = new Date();

    // Mendapatkan tahun, bulan, dan tanggal
    const year = currentDate.getFullYear().toString().substr(-2);
    const month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
    const day = ('0' + currentDate.getDate()).slice(-2);
    const timestamp = new Date().getTime(); // Waktu saat ini dalam milidetik
    const randomValue = Math.floor(Math.random() * 1000); // Nilai acak antara 0 dan 1000

    // Menggabungkan hasilnya
    const referenceNumber = `#PIU${year}${month}${day}${randomValue}`;
    $('#referenceNumberAdd').val(referenceNumber);
  }

  const formatRupiah = (angka) => {
  // Mengubah angka menjadi string dan memisahkan bagian desimal
  const strAngka = angka.toString().split('.');
  
  // Mengambil bagian angka tanpa desimal
  const angkaTanpaDesimal = strAngka[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');

  // Menggabungkan kembali bagian angka tanpa desimal dan bagian desimal
  const hasilFormat = `Rp ${angkaTanpaDesimal}${strAngka[1] ? ',' + strAngka[1] : ''}`;

  return hasilFormat;
}

$(function () {
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });
});
</script>