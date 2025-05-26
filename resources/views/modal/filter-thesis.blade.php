<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content font-smaller">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Cari Skripsi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="GET" action="{{ route('thesis') }}" class="mb-4 flex gap-2">
            <div class="mb-3 row">
                <label for="title" class="col-sm-3 col-form-label">Judul</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Masukkan Judul" id="title" name="title" value="{{ request('title') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="requirement" class="col-sm-3 col-form-label">Penulis</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control"  placeholder="Masukkan Penulis" id="author" name="author" value="{{ request('author') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="from_date" class="col-sm-3 col-form-label">Tahun</label>
                <div class="col-sm-9">
                    <select name="year" class="form-control">
                        <option value="{{ request('year') }}" selected>-- {{ request('year') ?? 'Pilih Tahun' }}</option>
                        @for ($year = date('Y'); $year >= 2021; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
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