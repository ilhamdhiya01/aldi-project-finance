<!-- Modal -->
<div class="modal fade" id="modalAddVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form onsubmit="handleAddVendor(event)" id="formAddVendor">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Form Tambah Vendor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" id="nameAdd">
            </div>
            <div class="form-group">
              <label>Telepon</label>
              <input type="text" class="form-control" id="phoneAdd">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" rows="3" id="addressAdd"></textarea>
            </div>
            <div class="form-group">
              <label>Status</label>
              <select class="custom-select" id="statusAdd">
                <option></option>
                <?php foreach($status as $vendorStatus): ?>
                  <option value="<?= $vendorStatus['optCode'] ?>"><?= $vendorStatus['optStatus'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="button-add-vendor" class="btn btn-primary btn-block">Simpan Vendor</button>
        </div>
      </form>
    </div>
  </div>
</div>