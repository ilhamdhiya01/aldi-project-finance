<!-- Modal -->
<div class="modal fade" id="modalUpdateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form onsubmit="handleUpdateUser(event)" id="formUpdateUser">
        <div class="modal-header">
          <h5 class="modal-title" id="titleFormUpdateUser">Form Detail User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="username">
            <input type="hidden" id="status">
            <div class="form-group">
              <input type="text" class="form-control form-control-border" id="nameEdit" readonly placeholder="Nama">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-border" id="usernameEdit" readonly placeholder="Username">
            </div>
            <div class="form-group <?= $this->session->userdata('roleUser') == 'Admin' ? 'd-none' : '' ?>">
              <select disabled class="custom-select form-control-border" id="roleEdit">
                <option></option>
                <?php foreach($roles as $role): ?>
                  <option value="<?= $role['optCode'] ?>"><?= $role['optStatus'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <select disabled placeholder="test" class="custom-select form-control-border" id="statusEdit">
                <option></option>
                <?php foreach($status as $userStatus): ?>
                  <option value="<?= $userStatus['optCode'] ?>"><?= $userStatus['optStatus'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <div class="row w-100">
            <div class="col-6">
              <button type="button" id="button-delete-user" onclick="handleButtonFormDetail('delete')"  class="btn btn-danger btn-block">Hapus User</button>
              <button type="button" id="button-cancel" onclick="handleButtonFormDetail('cancel')" class="btn btn-warning btn-block d-none">Batal</button>
            </div>
            <div class="col-6">
              <button type="button" id="button-edit-user" onclick="handleButtonFormDetail('edit')" class="btn btn-primary btn-block">Edit User</button>
              <button type="submit" id="button-update-user" class="btn btn-success btn-block d-none">Simpan Perubahan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>