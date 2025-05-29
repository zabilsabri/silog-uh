<div class="modal fade" id="deleteModal{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content font-smaller">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Mahasiswa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('students.delete.admin', $user->id) }}" class="mb-4">
                @csrf
                @method('DELETE')
                <p>Apakah Anda yakin ingin menghapus mahasiswa ini?</p>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
        </div>
        </form>
    </div>
  </div>
</div>
