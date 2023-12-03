<!-- Modal -->
<div class="modal fade" id="modalUpdateVehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form onsubmit="handleUpdateVehicle(event)" id="formUpdateVehicle">
        <div class="modal-header">
          <h5 class="modal-title" id="titleFormUpdateVehicle">Form Detail Kendaraan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="vehicleId">
            <div class="form-group">
              <label>Type</label>
              <input type="text" class="form-control" id="typeEdit">
            </div>
            <div class="form-group">
              <label>Plat Nomor</label>
              <input type="text" class="form-control" id="numberPlateEdit">
            </div>
            <div class="form-group">
              <label>Service Terakhir</label>
              <input type="date" class="form-control" id="lastServiceEdit">
            </div>
            <div class="form-group">
              <label>Service Kembali</label>
              <input type="date" class="form-control" id="serviceAgainEdit">
            </div>
            <div class="form-group">
              <label>Status</label>
              <select class="custom-select" id="statusEdit">
                <option></option>
                <?php foreach($status as $vehicleStatus): ?>
                  <option value="<?= $vehicleStatus['optCode'] ?>"><?= $vehicleStatus['optStatus'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <div class="row w-100">
            <div class="col-6">
              <button type="button" id="button-delete-vehicle" onclick="handleButtonFormDetail('delete')"  class="btn btn-danger btn-block">Hapus Kendaraan</button>
              <button type="button" id="button-cancel" onclick="handleButtonFormDetail('cancel')" class="btn btn-warning btn-block d-none">Batal</button>
            </div>
            <div class="col-6">
              <button type="button" id="button-edit-vehicle" onclick="handleButtonFormDetail('edit')" class="btn btn-primary btn-block">Edit Kendaraan</button>
              <button type="submit" id="button-update-vehicle" class="btn btn-success btn-block d-none">Simpan Perubahan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>