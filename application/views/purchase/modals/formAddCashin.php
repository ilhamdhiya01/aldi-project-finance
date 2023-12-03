<!-- Modal -->
<div class="modal fade" id="modalAddPurchase" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form onsubmit="handleAddPurchase(event)" id="formAddPurchase">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Form Tambah Pembelian</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Information</label>
              <input type="text" required class="form-control" id="informationAdd">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tanggal Pencatatan</label>
              <input type="date" required class="form-control" id="recordDateAdd">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Uang Masuk</label>
              <input type="number" required class="form-control" id="cashInAdd">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="button-add-cashin" class="btn btn-primary btn-block">Simpan Pemasukan</button>
        </div>
      </form>
    </div>
  </div>
</div>