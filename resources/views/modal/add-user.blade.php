<div class="modal fade" id="addUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content font-smaller">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="addUserModalLabel">Tambah Mahasiswa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('students.create.admin') }}" class="mb-3">
                @csrf
                <div>
                    <label for="formGroupExampleInput2" class="form-label">NIM<span class="text-danger"> *</span></label>
                    <input type="text" name="nim" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan NIM">
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
        </div>
        </form>
    </div>
  </div>
</div>
