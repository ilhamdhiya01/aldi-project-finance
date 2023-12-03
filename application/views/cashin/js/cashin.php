<script>
  $(document).ready(function() {
    showCashIn();
  });

  const showCashIn = () => {
    const today = new Date();

    // Mendapatkan tahun, bulan, dan tanggal
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');  // Bulan dimulai dari 0, sehingga ditambah 1
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;
    $('#listCashIn').html('');
    $.ajax({
      url: '<?= base_url('cashin/showCashIn') ?>',
      type: 'GET',
      success: function(data) {
        try {
          const cashin = JSON.parse(data);
          let totalArr = [];
          cashin.map((item, index) => {
            totalArr.push(parseInt(item.cashIn));
            $('#listCashIn').append(`
              <tr>
                <td>${index + 1}</td>
                <td>${item.information}</td>
                <td>${item.recordDate}</td>
                <td>${formatRupiah(item.cashIn)}</td>
                <td class="text-center">
                  <button onclick="handleDetailCashIn(\``+item.id+`\`)" data-toggle="modal" data-target="#modalUpdateCashIn" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Detail</button>
                </td>
              </tr>
            `);
          });
          const totalCashIn = totalArr.reduce((total, element) => {
            return total + element;
          }, 0)
          $('#total-pemasukan').text(`Total Pemasukan : ${formatRupiah(totalCashIn)}`);
        } catch (error) {
          console.log(error);
        }
      }
    })
  }

  const handleAddCashIn = (e) => {
    e.preventDefault();
    $('#button-add-cashin').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('cashin/addCashIn') ?>',
      type: 'POST',
      data: {
        information: $('#informationAdd').val(),
        recordDate: $('#recordDateAdd').val(),
        cashIn: $('#cashInAdd').val()
      },
      success: function(data) {
        $('#button-add-cashin').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showCashIn();
          $('#modalAddCashIn').modal('hide');
          $('#formAddCashIn')[0].reset();
        }
      }
    })
  }

  const handleDetailCashIn = (id) => {
    // change button
    $('#button-edit-cashin').removeClass('d-none');
    $('#button-update-cashin').addClass('d-none');
    $('#button-delete-cashin').removeClass('d-none');
    $('#button-cancel').addClass('d-none');
    // unreadonlu
    $('#informationEdit').prop('readonly', true);
    $('#recordDateEdit').prop('disabled', true);
    $('#cashInEdit').prop('readonly', true);

    $.ajax({
      url: '<?= base_url('cashin/cashInDetail') ?>',
      type: 'GET',
      data: {
        id: id
      },
      success: function(data) {
        const {id, information, recordDate, cashIn } = JSON.parse(data);

        $('#idEdit').val(id);
        $('#informationEdit').val(information);
        $('#recordDateEdit').val(recordDate);
        $('#cashInEdit').val(cashIn);
      }
    })
  }


  const handleUpdateCashIn = (e) => {
    e.preventDefault();
    $('#button-update-cashin').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('cashin/updateCashIn') ?>',
      type: 'POST',
      data: {
        id: $('#idEdit').val(),
        information: $('#informationEdit').val(),
        recordDate: $('#recordDateEdit').val(),
        cashIn: $('#cashInEdit').val()
      },
      success: function(data) {
        $('#button-update-cashin').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showCashIn();
          $('#modalUpdateCashIn').modal('hide');
          $('#formUpdateCashIn')[0].reset();
        }
      }
    })
  }

  const handleDeletelCashIn = (id) => {
    $.ajax({
      url: '<?= base_url('cashin/deleteCashIn') ?>',
      type: 'GET',
      data: {
        id: id
      },
      success: function(data) {
        const {status, message} = JSON.parse(data);
        if(status == 'success') {
          toastr.success(message);
          showCashIn();
          $('#modalUpdateCashIn').modal('hide');
        }
      }
    })
  }

  const handleButtonFormDetail = (type) => {
    switch (type) {
      case 'edit':
        // change button
        $('#button-edit-cashin').addClass('d-none');
        $('#button-update-cashin').removeClass('d-none');
        $('#button-delete-cashin').addClass('d-none');
        $('#button-cancel').removeClass('d-none');
        // unreadonlu
        $('#informationEdit').prop('readonly', false);
        $('#recordDateEdit').prop('disabled', false);
        $('#cashInEdit').prop('readonly', false);
        break;
      case 'delete':
        const id = $('#idEdit').val();
        const confirmDelete = confirm(`Hapus data ini ?`) ;
        if(confirmDelete) {
          handleDeletelCashIn(id);
        }
        break;
      default:
        // change button
        $('#button-edit-cashin').removeClass('d-none');
        $('#button-update-cashin').addClass('d-none');
        $('#button-delete-cashin').removeClass('d-none');
        $('#button-cancel').addClass('d-none');
        // unreadonlu
        $('#informationEdit').prop('readonly', true);
        $('#recordDateEdit').prop('disabled', true);
        $('#cashInEdit').prop('readonly', true);
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
  $('#tableCashIn').DataTable({
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