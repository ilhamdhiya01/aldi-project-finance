<!-- Modal -->
<div class="modal fade" id="modalAddVehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form onsubmit="handleAddVehicle(event)" id="formAddVehicle">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Form Tambah Kendaraan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label>Type</label>
              <input type="text" class="form-control" id="typeAdd">
            </div>
            <div class="form-group">
              <label>Plat Nomor</label>
              <input type="text" class="form-control" id="numberPlateAdd">
            </div>
            <div class="form-group">
              <label>Service Terakhir</label>
              <input type="date" class="form-control" id="lastServiceAdd">
            </div>
            <div class="form-group">
              <label>Service Kembali</label>
              <input type="date" class="form-control" id="serviceAgainAdd">
            </div>
            <div class="form-group">
              <label>Status</label>
              <select class="custom-select" id="statusAdd">
                <option></option>
                <?php foreach($status as $vehicleStatus): ?>
                  <option value="<?= $vehicleStatus['optCode'] ?>"><?= $vehicleStatus['optStatus'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="button-add-vehicle" class="btn btn-primary btn-block">Simpan Kendaraan</button>
        </div>
      </form>
    </div>
  </div>
</div>