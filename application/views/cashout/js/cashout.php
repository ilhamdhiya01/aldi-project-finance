<script>
  $(document).ready(function() {
    showCashOut();
  });

  const showCashOut = () => {
    $('#listCashOut').html('');
    $.ajax({
      url: '<?= base_url('cashout/showCashOut') ?>',
      type: 'GET',
      success: function(data) {
        try {
          const cashout = JSON.parse(data);
          let totalArr = [];
          cashout.map((item, index) => {
            totalArr.push(parseInt(item.cashOut));
            $('#listCashOut').append(`
              <tr>
                <td>${index + 1}</td>
                <td>${item.information}</td>
                <td>${item.recordDate}</td>
                <td>${formatRupiah(item.cashOut)}</td>
                <td class="text-center">
                  <button onclick="handleDetailCashOut(\``+item.id+`\`)" data-toggle="modal" data-target="#modalUpdateCashOut" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Detail</button>
                </td>
              </tr>
            `);
          });
          const totalCashOut = totalArr.reduce((total, element) => {
            return total + element;
          }, 0)
          $('#total-pengeluaran').text(`Total Pengeluaran : ${formatRupiah(totalCashOut)}`);
        } catch (error) {
          console.log(error);
        }
      }
    })
  }

  const handleAddCashOut = (e) => {
    e.preventDefault();
    $('#button-add-cashout').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('cashout/addCashOut') ?>',
      type: 'POST',
      data: {
        information: $('#informationAdd').val(),
        recordDate: $('#recordDateAdd').val(),
        cashOut: $('#cashOutAdd').val()
      },
      success: function(data) {
        $('#button-add-cashout').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showCashOut();
          $('#modalAddCashOut').modal('hide');
          $('#formAddCashOut')[0].reset();
        }
      }
    })
  }

  const handleDetailCashOut = (id) => {
    // change button
    $('#button-edit-cashout').removeClass('d-none');
    $('#button-update-cashout').addClass('d-none');
    $('#button-delete-cashout').removeClass('d-none');
    $('#button-cancel').addClass('d-none');
    // unreadonlu
    $('#informationEdit').prop('readonly', true);
    $('#recordDateEdit').prop('disabled', true);
    $('#cashOutEdit').prop('readonly', true);

    $.ajax({
      url: '<?= base_url('cashout/cashOutDetail') ?>',
      type: 'GET',
      data: {
        id: id
      },
      success: function(data) {
        const {id, information, recordDate, cashOut } = JSON.parse(data);

        $('#idEdit').val(id);
        $('#informationEdit').val(information);
        $('#recordDateEdit').val(recordDate);
        $('#cashOutEdit').val(cashOut);
      }
    })
  }


  const handleUpdateCashOut = (e) => {
    e.preventDefault();
    $('#button-update-cashout').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('cashout/updateCashOut') ?>',
      type: 'POST',
      data: {
        id: $('#idEdit').val(),
        information: $('#informationEdit').val(),
        recordDate: $('#recordDateEdit').val(),
        cashOut: $('#cashOutEdit').val()
      },
      success: function(data) {
        $('#button-update-cashOut').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          showCashOut();
          $('#modalUpdateCashOut').modal('hide');
          $('#formUpdateCashOut')[0].reset();
        }
      }
    })
  }

  const handleDeletelCashOut = (id) => {
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
          showCashOut();
          $('#modalUpdateCashOut').modal('hide');
        }
      }
    })
  }

  const handleButtonFormDetail = (type) => {
    switch (type) {
      case 'edit':
        // change button
        $('#button-edit-cashout').addClass('d-none');
        $('#button-update-cashout').removeClass('d-none');
        $('#button-delete-cashout').addClass('d-none');
        $('#button-cancel').removeClass('d-none');
        // unreadonlu
        $('#informationEdit').prop('readonly', false);
        $('#recordDateEdit').prop('disabled', false);
        $('#cashOutEdit').prop('readonly', false);
        break;
      case 'delete':
        const id = $('#idEdit').val();
        const confirmDelete = confirm(`Hapus data ini ?`) ;
        if(confirmDelete) {
          handleDeletelCashOut(id);
        }
        break;
      default:
        // change button
        $('#button-edit-cashout').removeClass('d-none');
        $('#button-update-cashout').addClass('d-none');
        $('#button-delete-cashout').removeClass('d-none');
        $('#button-cancel').addClass('d-none');
        // unreadonlu
        $('#informationEdit').prop('readonly', true);
        $('#recordDateEdit').prop('disabled', true);
        $('#cashOutEdit').prop('readonly', true);
        break;
    }
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
</script>