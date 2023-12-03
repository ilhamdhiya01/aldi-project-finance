<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Large Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card card-primary card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Form Cicilan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Record Cicilan</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <form onsubmit="handleAddCicilan(event)" id="formAddCicilan">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nomor Referensi</label>
                        <input type="text" readonly class="form-control" id="referenceNumberDetail">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama Kreditur</label>
                        <input type="text" readonly required class="form-control" id="creditorNameDetail">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Pencatatan</label>
                        <input type="date" required class="form-control" id="recordDateDetail">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Dibayarkan</label>
                        <input type="number" required class="form-control" id="totalDebtDetail">
                      </div>
                      <button type="submit" id="button-add-cicilan-utang" class="btn btn-primary btn-block">Simpan Cicilan</button>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                      <h4>Total terbayar :</h4>
                      <h4 id="totalCicilan"></h4>
                    </div>
                    <br>
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nomor Referensi</th>
                          <th>Debitur</th>
                          <th>Tanggal Pencatatan</th>
                          <th>Dibayarkan</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="recordCicilan">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  
      </div>
      <div class="modal-footer justify-content-between">
      </div>
    </div>
  </div>
</div>