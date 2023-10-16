<!-- Modal -->
<div class="modal fade" id="modalUpdateVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form onsubmit="handleUpdateVendor(event)" id="formUpdateVendor">
        <div class="modal-header">
          <h5 class="modal-title" id="titleFormUpdateUser">Form Detail User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="vendorId">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" id="nameEdit" readonly>
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input type="text" class="form-control" id="phoneEdit" readonly>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" rows="3" id="addressEdit"></textarea>
            </div>
            <div class="form-group">
              <label>Status</label>
              <select disabled placeholder="test" class="custom-select" id="statusEdit">
                <option></option>
                <?php foreach($status as $vendorStatus): ?>
                  <option value="<?= $vendorStatus['optCode'] ?>"><?= $vendorStatus['optStatus'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <div class="row w-100">
            <div class="col-6">
              <button type="button" id="button-delete-vendor" onclick="handleButtonFormDetail('delete')"  class="btn btn-danger btn-block">Hapus Vendor</button>
              <button type="button" id="button-cancel" onclick="handleButtonFormDetail('cancel')" class="btn btn-warning btn-block d-none">Batal</button>
            </div>
            <div class="col-6">
              <button type="button" id="button-edit-vendor" onclick="handleButtonFormDetail('edit')" class="btn btn-primary btn-block">Edit Vendor</button>
              <button type="submit" id="button-update-vendor" class="btn btn-success btn-block d-none">Simpan Perubahan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>