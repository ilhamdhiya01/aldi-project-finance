<!-- Modal -->
<div class="modal fade" id="modalAddUtang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form onsubmit="handleAddUtang(event)" id="formAddUtang">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Form Tambah Utang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nomor Referensi</label>
              <input type="text" readonly class="form-control" id="referenceNumberAdd">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Kreditur</label>
              <input type="text" required class="form-control" id="creditorNameAdd">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tanggal Pencatatan</label>
              <input type="date" required class="form-control" id="recordDateAdd">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Batas Pelunasan</label>
              <input type="date" required class="form-control" id="dueDateAdd">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Total Utang</label>
              <input type="number" required class="form-control" id="initialDebtAdd">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="button-add-Utang" class="btn btn-primary btn-block">Simpan Utang</button>
        </div>
      </form>
    </div>
  </div>
</div>