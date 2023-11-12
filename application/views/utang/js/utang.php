<script>
  $(document).ready(function() {
    showDebt();
  });

  const showCicilan = (referenceNumber) => {
    $('#recordCicilan').html('');
    $.ajax({
      url: '<?= base_url('utang/showCicilan') ?>',
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
                <td class="text-center">
                  <button onclick="handleDeleteCicilan(\``+item.id+`\`, \``+item.referenceNumber+`\`)" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
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


  const showDebt = () => {
    const today = new Date();

    // Mendapatkan tahun, bulan, dan tanggal
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');  // Bulan dimulai dari 0, sehingga ditambah 1
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;
    $('#listDebt').html('');
    $.ajax({
      url: '<?= base_url('utang/showDebt') ?>',
      type: 'GET',
      success: function(data) {
        try {
          const debt = JSON.parse(data);
          if(debt.length == 0) {
            $('#listDebt').append(`
              <div class="card p-3 d-flex flex-md-row justify-content-between text-sm">
                <div class="d-flex justify-content-center align-items-center w-100" style="height: 150px;">
                  <h4>No data yet</h4>
                </div>
              </div>
            `);
            return;
          }

          debt.map((item) => {
            $('#listDebt').append(`
              <div class="card p-3 d-flex flex-md-row align-items-center">
                <div class="row w-100">
                  <div class="col-md-2 d-flex flex-md-column text-sm">
                    <span class=" font-weight-light">Nomor Referensi</span>
                    <span class="">${item.referenceNumber}</span>
                  </div>
                  <div class="col-md-2 d-flex flex-md-column text-sm">
                    <span class=" font-weight-light">Kreditur</span>
                    <span class="">${item.creditorName}</span>
                  </div>
                  <div class="col-md-2 d-flex flex-md-column text-sm">
                    <span class=" font-weight-light">Tanggal Pencatatan</span>
                    <span class="">${item.recordDate}</span>
                  </div>
                  <div class="col-md-2 d-flex flex-md-column text-sm">
                    <span class=" font-weight-light">Terakhir Dibayarkan</span>
                    <span class="">${item.lastPaymentDate}</span>
                  </div>
                  <div class="col-md-2 d-flex flex-md-column text-sm">
                    <span class=" font-weight-light">Utang Awal</span>
                    <span class="">${formatRupiah(item.utangAwal)}</span>
                  </div>
                  <div class="col-2 d-flex flex-md-column">
                    <span class=" font-weight-light">Status</span>
                    <span style="width: 90px;" class="badge ${item.lastPaymentDate == null ? 'badge-warning' : formattedDate > item.lastPaymentDate  ? 'badge-danger' : formattedDate >= item.lastPaymentDate  ? 'badge-warning' : 'badge-success'}">${item.lastPaymentDate == null || formattedDate == item.lastPaymentDate ? 'Jatuh tempo' : formattedDate > item.lastPaymentDate  ? 'Terlambat' : 'Sudah terbayar'}</span>
                  </div>
                </div>
                <div class="d-flex flex-row align-items-center" style="column-gap: 5px;">
                <button onclick="handleDetailUtang(\``+item.referenceNumber+`\`, 'detail')" data-toggle="modal" data-target="#modalUpdateUtang" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Detail</button>
                ${item.total != item.initialDebt ? `<button onclick="handleDetailUtang(\``+item.referenceNumber+`\`, 'cicilan')" data-toggle="modal" data-toggle="modal" data-target="#modal-lg" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Cicilan</button>` : '<span class="badge badge-success">Lunas</span>'}
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

  const handleAddUtang = (e) => {
    e.preventDefault();
    $('#button-add-utang').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('utang/addUtang') ?>',
      type: 'POST',
      data: {
        referenceNumber: $('#referenceNumberAdd').val(),
        creditorName: $('#creditorNameAdd').val(),
        recordDate: $('#recordDateAdd').val(),
        dueDate: $('#dueDateAdd').val(),
        initialDebt: $('#initialDebtAdd').val()
      },
      success: function(data) {
        $('#button-add-utang').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showDebt();
          $('#modalAddUtang').modal('hide');
          $('#formAddUtang')[0].reset();
        }
      }
    })
  }

  const handleAddCicilan = (e) => {
    e.preventDefault();
    $('#button-add-cicilan-utang').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('utang/addCicilan') ?>',
      type: 'POST',
      data: {
        referenceNumber: $('#referenceNumberDetail').val(),
        creditorName: $('#creditorNameDetail').val(),
        recordDate: $('#recordDateDetail').val(),
        totalDebt: $('#totalDebtDetail').val()
      },
      success: function(data) {
        $('#button-add-cicilan-utang').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showCicilan();
          showDebt();
          $('#modal-lg').modal('hide');
          $('#formAddCicilan')[0].reset();
        }
      }
    })
  }


  const handleDetailUtang = (referenceNumber, type) => {
    if(type === 'detail') {
      // change button
      $('#button-edit-utang').removeClass('d-none');
      $('#button-update-utang').addClass('d-none');
      $('#button-delete-utang').removeClass('d-none');
      $('#button-cancel').addClass('d-none');
      // unreadonlu
      $('#referenceNumberEdit').prop('readonly', true);
      $('#creditorNameEdit').prop('readonly', true);
      $('#recordDateEdit').prop('disabled', true)
      $('#dueDateEdit').prop('disabled', true)
      $('#initialDebtEdit').prop('readonly', true)
    }

    $.ajax({
      url: '<?= base_url('utang/utangDetail') ?>',
      type: 'GET',
      data: {
        referenceNumber: referenceNumber
      },
      success: function(data) {
        const {referenceNumber, creditorName, recordDate, dueDate, initialDebt } = JSON.parse(data);
        if(type !== 'detail') {
          $('#referenceNumberDetail').val(referenceNumber);
          $('#creditorNameDetail').val(creditorName);
          showCicilan(referenceNumber);
        }

        if(type === 'detail') {
          $('#referenceNumberEdit').val(referenceNumber);
          $('#creditorNameEdit').val(creditorName);
          $('#recordDateEdit').val(recordDate)
          $('#dueDateEdit').val(dueDate)
          $('#initialDebtEdit').val(initialDebt)
        }
      }
    })
  }

  const handleDeleteCicilan = (id, referenceNumber) => {
    if(confirm('Delete cicilan ini ?')) {
      $.ajax({
        url: '<?= base_url('utang/deleteCicilan') ?>',
        type: 'GET',
        data: {
          id: id,
          referenceNumber: referenceNumber
        },
        success: function(data) {
          const {status, message} = JSON.parse(data);
          if(status == 'success') {
            toastr.success(message);
            showCicilan(referenceNumber);
            showDebt();
          }
        }
      });
    }
  }

  const handleUpdateUtang = (e) => {
    e.preventDefault();
    $('#button-update-utang').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('utang/updateUtang') ?>',
      type: 'POST',
      data: {
        referenceNumber: $('#referenceNumberEdit').val(),
        creditorName: $('#creditorNameEdit').val(),
        recordDate: $('#recordDateEdit').val(),
        dueDate: $('#dueDateEdit').val(),
        initialDebt: $('#initialDebtEdit').val()
      },
      success: function(data) {
        $('#button-update-utang').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showDebt();
          $('#modalUpdateUtang').modal('hide');
          $('#formUpdateUtang')[0].reset();
        }
      }
    })
  }

  const handleDeletelUtang = (referenceNumber) => {
    $.ajax({
      url: '<?= base_url('utang/deleteUtang') ?>',
      type: 'GET',
      data: {
        referenceNumber: referenceNumber
      },
      success: function(data) {
        const {status, message} = JSON.parse(data);
        if(status == 'success') {
          toastr.success(message);
          showDebt();
          $('#modalUpdateUtang').modal('hide');
        }
      }
    })
  }

  const handleButtonFormDetail = (type) => {
    switch (type) {
      case 'edit':
        // change button
        $('#button-edit-utang').addClass('d-none');
        $('#button-update-utang').removeClass('d-none');
        $('#button-delete-utang').addClass('d-none');
        $('#button-cancel').removeClass('d-none');
        // unreadonlu
        $('#referenceNumberEdit').prop('readonly', false);
        $('#creditorNameEdit').prop('readonly', false);
        $('#recordDateEdit').prop('disabled', false)
        $('#dueDateEdit').prop('disabled', false)
        $('#initialDebtEdit').prop('readonly', false)
        break;
      case 'delete':
        const referenceNumber = $('#referenceNumberEdit').val();
        const confirmDelete = confirm(`Hapus data ini ?`) ;
        if(confirmDelete) {
          handleDeletelUtang(referenceNumber);
        }
        break;
      default:
        // change button
        $('#button-edit-utang').removeClass('d-none');
        $('#button-update-utang').addClass('d-none');
        $('#button-delete-Utang').removeClass('d-none');
        $('#button-cancel').addClass('d-none');
        // unreadonlu
        $('#referenceNumberEdit').prop('readonly', true);
        $('#creditorNameEdit').prop('readonly', true);
        $('#recordDateEdit').prop('disabled', true)
        $('#dueDateEdit').prop('disabled', true)
        $('#initialDebtEdit').prop('readonly', true)
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
    const referenceNumber = `#UTG${year}${month}${day}${randomValue}`;
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