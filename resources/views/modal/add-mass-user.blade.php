<div class="modal fade" id="addMassUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMassUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content font-smaller">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="addMassUserModalLabel">Tambah Massal Mahasiswa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('students.create.mass.admin') }}" class="mb-3" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="formFile" class="form-label">File (xls)<span class="text-danger"> *</span></label>
                    <input class="form-control" name="fileUser" type="file" id="formFile">
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" id="submitBtn" class="btn btn-sm btn-primary">
                <span id="submitBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                <span id="submitBtnText">Tambah</span>
            </button>
        </div>
        </form>
    </div>
  </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form[action="{{ route('students.create.mass.admin') }}"]');
        const submitBtn = document.getElementById('submitBtn');
        const submitBtnText = document.getElementById('submitBtnText');
        const submitBtnSpinner = document.getElementById('submitBtnSpinner');

        if (form) {
            form.addEventListener('submit', function () {
                submitBtn.disabled = true;
                submitBtnSpinner.classList.remove('d-none');
                submitBtnText.textContent = 'Mengunggah...';
            });
        }
    });
</script>