
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form onsubmit="handleAddUser(event)" id="formAddUser">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Form Tambah User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <input type="text" class="form-control form-control-border" id="name" placeholder="Nama">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-border" id="username" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="password" class="form-control form-control-border" id="password" placeholder="Password">
            </div>
            <div class="form-group">
              <select class="custom-select form-control-border" id="role">
                <option></option>
                <?php foreach($roles as $role): ?>
                  <option value="<?= $role['optCode'] ?>"><?= $role['optStatus'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <select placeholder="test" class="custom-select form-control-border" id="status">
                <option></option>
                <?php foreach($status as $userStatus): ?>
                  <option value="<?= $userStatus['optCode'] ?>"><?= $userStatus['optStatus'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="button-add-user" class="btn btn-primary btn-block">Save User</button>
        </div>
      </form>
    </div>
  </div>
</div>