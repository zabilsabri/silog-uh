<div class="modal fade" id="studentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content font-smaller">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="studentModalLabel">Cari Mahasiswa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="GET" action="{{ route('students.admin') }}" class="mb-4 flex gap-2">
            <div class="mb-3 row">
                <label for="name" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Masukkan Nama" id="name" name="name" value="{{ request('name') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="requirement" class="col-sm-3 col-form-label">NIM</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control"  placeholder="Masukkan NIM" id="nim" name="username" value="{{ request('nim') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="from_date" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option value="{{ request('status') }}" selected>-- {{ request('status') ?? 'Pilih Status' }}</option>
                        <option value="Sudah Upload">Sudah Upload</option>
                        <option value="Belum Upload">Belum Upload</option>
                    </select>
                </div>
            </div> 
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Cari</button>
        </div>
        </form>
    </div>
  </div>
</div>