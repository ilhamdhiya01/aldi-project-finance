<!-- Modal -->
<div class="modal fade" id="modalUpdatePiutang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form onsubmit="handleUpdatePiutang(event)" id="formUpdatePiutang">
        <div class="modal-header">
          <h5 class="modal-title" id="titleFormUpdateUser">Form Detail Piutang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Nomor Referensi</label>
            <input type="text" readonly class="form-control" id="referenceNumberEdit">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Debitur</label>
            <input type="text" readonly required class="form-control" id="debtorNameEdit">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Tanggal Pencatatan</label>
            <input type="date" disabled required class="form-control" id="recordDateEdit">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Batas Pelunasan</label>
            <input type="date" disabled required class="form-control" id="dueDateEdit">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Total Piutang</label>
            <input type="number" readonly required class="form-control" id="initialReceivableEdit">
          </div>     
        </div>
        <div class="modal-footer">
          <div class="row w-100">
            <div class="col-6">
              <button type="button" id="button-delete-piutang" onclick="handleButtonFormDetail('delete')"  class="btn btn-danger btn-block">Hapus Piutang</button>
              <button type="button" id="button-cancel" onclick="handleButtonFormDetail('cancel')" class="btn btn-warning btn-block d-none">Batal</button>
            </div>
            <div class="col-6">
              <button type="button" id="button-edit-piutang" onclick="handleButtonFormDetail('edit')" class="btn btn-primary btn-block">Edit Piutang</button>
              <button type="submit" id="button-update-piutang" class="btn btn-success btn-block d-none">Simpan Perubahan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>