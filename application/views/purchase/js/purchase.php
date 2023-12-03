<script>
  $(document).ready(function() {
    showPurchase();
  });

  const showPurchase = () => {
    $('#listPurchase').html('');
    $.ajax({
      url: '<?= base_url('purchase/showPurchase') ?>',
      type: 'GET',
      success: function(data) {
        try {
          const purchase = JSON.parse(data);
          purchase.map((item, index) => {
            $('#listPurchase').append(`
              <tr>
                <td>${index + 1}</td>
                <td>${item.information}</td>
                <td>${item.recordDate}</td>
                <td>${formatRupiah(item.purchase)}</td>
                <td class="text-center">
                  <button onclick="handleDetailpurchase(\``+item.id+`\`)" data-toggle="modal" data-target="#modalUpdatepurchase" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Detail</button>
                </td>
              </tr>
            `);
          });
        } catch (error) {
          console.log(error);
        }
      }
    })
  }

  const handleAddPurchase = (e) => {
    e.preventDefault();
    $('#button-add-purchase').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('purchase/addPurchase') ?>',
      type: 'POST',
      data: {
        information: $('#informationAdd').val(),
        recordDate: $('#recordDateAdd').val(),
        purchase: $('#purchaseAdd').val()
      },
      success: function(data) {
        $('#button-add-purchase').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          purchase();
          $('#modalAddpurchase').modal('hide');
          $('#formAddpurchase')[0].reset();
        }
      }
    })
  }

  const handleDetailPurchase = (id) => {
    // change button
    $('#button-edit-purchase').removeClass('d-none');
    $('#button-update-purchase').addClass('d-none');
    $('#button-delete-purchase').removeClass('d-none');
    $('#button-cancel').addClass('d-none');
    // unreadonlu
    $('#informationEdit').prop('readonly', true);
    $('#recordDateEdit').prop('disabled', true);
    $('#purchaseEdit').prop('readonly', true);

    $.ajax({
      url: '<?= base_url('purchase/purchaseDetail') ?>',
      type: 'GET',
      data: {
        id: id
      },
      success: function(data) {
        const {id, information, recordDate, purchase } = JSON.parse(data);

        $('#idEdit').val(id);
        $('#informationEdit').val(information);
        $('#recordDateEdit').val(recordDate);
        $('#purchaseEdit').val(purchase);
      }
    })
  }


  const handleUpdatepurchase = (e) => {
    e.preventDefault();
    $('#button-update-purchase').prop('disabled', true);
    $.ajax({
      url: '<?= base_url('purchase/updatepurchase') ?>',
      type: 'POST',
      data: {
        id: $('#idEdit').val(),
        information: $('#informationEdit').val(),
        recordDate: $('#recordDateEdit').val(),
        purchase: $('#purchaseEdit').val()
      },
      success: function(data) {
        $('#button-update-purchase').prop('disabled', false);
        const response = JSON.parse(data);

        if(response.code == 200 && response.status == 'success') {
          toastr.success(response.message);
          purchase();
          $('#modalUpdatepurchase').modal('hide');
          $('#formUpdatepurchase')[0].reset();
        }
      }
    })
  }

  const handleDeletelpurchase = (id) => {
    $.ajax({
      url: '<?= base_url('purchase/deletepurchase') ?>',
      type: 'GET',
      data: {
        id: id
      },
      success: function(data) {
        const {status, message} = JSON.parse(data);
        if(status == 'success') {
          toastr.success(message);
          purchase();
          $('#modalUpdatepurchase').modal('hide');
        }
      }
    })
  }

  const handleButtonFormDetail = (type) => {
    switch (type) {
      case 'edit':
        // change button
        $('#button-edit-purchase').addClass('d-none');
        $('#button-update-purchase').removeClass('d-none');
        $('#button-delete-purchase').addClass('d-none');
        $('#button-cancel').removeClass('d-none');
        // unreadonlu
        $('#informationEdit').prop('readonly', false);
        $('#recordDateEdit').prop('disabled', false);
        $('#purchaseEdit').prop('readonly', false);
        break;
      case 'delete':
        const id = $('#idEdit').val();
        const confirmDelete = confirm(`Hapus data ini ?`) ;
        if(confirmDelete) {
          handleDeletelpurchase(id);
        }
        break;
      default:
        // change button
        $('#button-edit-purchase').removeClass('d-none');
        $('#button-update-purchase').addClass('d-none');
        $('#button-delete-purchase').removeClass('d-none');
        $('#button-cancel').addClass('d-none');
        // unreadonlu
        $('#informationEdit').prop('readonly', true);
        $('#recordDateEdit').prop('disabled', true);
        $('#purchaseEdit').prop('readonly', true);
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
  $('#tablepurchase').DataTable({
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