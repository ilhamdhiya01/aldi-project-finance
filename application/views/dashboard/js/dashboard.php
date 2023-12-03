<script>
  $(document).ready(function() {
    totalRevenue();
    totalExpenditure();
  });

  const totalRevenue = () => {
    $.ajax({
      url: '<?= base_url('dashboard/totalRevenue') ?>',
      type: 'GET',
      success: function(data) {
        try {
          const revenue = JSON.parse(data);
          let totalArr = [];
          revenue.map((item, index) => {
            totalArr.push(parseInt(item.cashIn));
          });
          const totalRevenue = totalArr.reduce((total, element) => {
            return total + element;
          }, 0)
          $('#total-revenue').text(formatRupiah(totalRevenue));
        } catch (error) {
          console.log(error);
        }
      }
    })
  }
  const totalExpenditure = () => {
    $.ajax({
      url: '<?= base_url('dashboard/totalExpenditure') ?>',
      type: 'GET',
      success: function(data) {
        try {
          const expenditure = JSON.parse(data);
          let totalArr = [];
          expenditure.map((item, index) => {
            totalArr.push(parseInt(item.cashOut));
          });
          const totalExpenditure = totalArr.reduce((total, element) => {
            return total + element;
          }, 0)
          $('#total-expenditure').text(formatRupiah(totalExpenditure));
        } catch (error) {
          console.log(error);
        }
      }
    })
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