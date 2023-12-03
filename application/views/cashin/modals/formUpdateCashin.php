<!-- Modal -->
<div class="modal fade" id="modalUpdateCashIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form onsubmit="handleUpdateCashIn(event)" id="formUpdateCashIn">
        <div class="modal-header">
          <h5 class="modal-title" id="titleFormUpdateUser">Form Detail CashIn</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" id="idEdit">
          <div class="form-group">
            <label for="exampleInputEmail1">Informasi</label>
            <input type="text" readonly required class="form-control" id="informationEdit">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Tanggal Pencatatan</label>
            <input type="date" disabled required class="form-control" id="recordDateEdit">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Jumlah Pemasukan</label>
            <input type="number" required class="form-control" id="cashInEdit">
          </div>
        </div>
        <div class="modal-footer">
          <div class="row w-100">
            <div class="col-6">
              <button type="button" id="button-delete-cashin" onclick="handleButtonFormDetail('delete')"  class="btn btn-danger btn-block">Hapus Pemasukan</button>
              <button type="button" id="button-cancel" onclick="handleButtonFormDetail('cancel')" class="btn btn-warning btn-block d-none">Batal</button>
            </div>
            <div class="col-6">
              <button type="button" id="button-edit-cashin" onclick="handleButtonFormDetail('edit')" class="btn btn-primary btn-block">Edit Pemasukan</button>
              <button type="submit" id="button-update-cashin" class="btn btn-success btn-block d-none">Simpan Perubahan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>