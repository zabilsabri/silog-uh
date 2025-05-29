<div class="modal fade" id="editProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content font-smaller">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="editProfileLabel">Upload Skripsi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="formGroupExampleInput" class="form-label">Nama Depan<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="first_name" value="{{ Auth::user()->first_name }}" placeholder="Masukkan nama depan">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="formGroupExampleInput" class="form-label">Nama Belakang<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="last_name" value="{{ Auth::user()->last_name }}" placeholder="Masukkan nama belakang">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="formGroupExampleInput2" class="form-label">NIM<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" value="{{ Auth::user()->username }}" placeholder="Masukkan NIM" disabled>
                </div>
                <hr>
                <div class="mb-4">
                    <label for="formGroupExampleInput2" class="form-label">Judul Skripsi<span class="text-danger"> *</span></label>
                    <textarea name="thesis_title" id="" class="form-control" rows="3" placeholder="Masukkan Judul Skripsi">{{ Auth::user()->thesis->title ?? '' }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="formGroupExampleInput2" class="form-label">Abstrak<span class="text-danger"> *</span></label>
                    <textarea name="thesis_abstract" id="" class="form-control" rows="5" placeholder="Masukkan Abstrak">{{ Auth::user()->thesis->abstract ?? '' }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="formGroupExampleInput2" class="form-label">Pembimbing Utama<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" name="supervisor" value="{{ Auth::user()->thesis->supervisor ?? '' }}" placeholder="Masukkan Nama Pembimbing">
                </div>
                <div class="mb-4">
                    <label for="formGroupExampleInput2" class="form-label">Tahun<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" name="year" value="{{ Auth::user()->thesis->year ?? '' }}" placeholder="Masukkan Tahun">
                </div>
                <div class="mb-4">
                    <label for="formGroupExampleInput2" class="form-label">Penguji<span class="text-danger"> *</span></label>
                    <ol id="examiner-list-head">
                        @forelse(Auth::user()->thesis->examiner ?? [] as $examinerList)
                            <li class="examiner-list">
                                <input type="text" class="form-control mb-2" id="formGroupExampleInput2" name="examiners[]" value="{{ $examinerList->name }}" placeholder="Masukkan Nama Penguji">
                            </li>
                        @empty
                            <li class="examiner-list">
                                <input type="text" class="form-control mb-2" id="formGroupExampleInput2" name="examiners[]" placeholder="Masukkan Nama Penguji">
                            </li>
                            <li class="examiner-list">
                                <input type="text" class="form-control mb-2" id="formGroupExampleInput2" name="examiners[]" placeholder="Masukkan Nama Penguji">
                            </li>
                        @endforelse
                    </ol>
                    <div class="d-grid gap-2">
                        <button id="addmore" class="btn btn-sm btn-outline-primary" type="button">+</button>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="formGroupExampleInput2" class="form-label">File Skripsi (word, pdf)<span class="text-danger"> *</span></label>
                    <input type="file" name="file_thesis" class="form-control" id="inputGroupFile02">
                    @if(!empty(Auth::user()->thesis->file_path) && !empty(Auth::user()->thesis->file_name))
                        <small>File yang sudah diunggah: <a href="{{ asset('storage/'.Auth::user()?->thesis?->file_path) }}">{{ Auth::user()->thesis->file_name }}</a></small>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="formGroupExampleInput2" class="form-label">File Source Code (zip)</label>
                    <input type="file" name="file_source_code" class="form-control" id="inputGroupFile02">
                    @if(!empty(Auth::user()->thesis->source_code_path) && !empty(Auth::user()->thesis->source_code_name))
                        <small>File yang sudah diunggah: <a href="{{ asset('storage/'.Auth::user()->thesis->source_code_path) }}">{{ Auth::user()->thesis->source_code_name }}</a></small>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">File Sumber Data (excel, csv)</label>
                    <input type="file" name="file_data_source" class="form-control" id="inputGroupFile02">
                    @if(!empty(Auth::user()->thesis->file_data_source_path) && !empty(Auth::user()->thesis->file_data_source_name))
                        <small>File yang sudah diunggah: <a href="{{ asset('storage/'.Auth::user()->thesis->file_data_source_path) }}">{{ Auth::user()->thesis->file_data_source_name }}</a></small>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="formGroupExampleInput2" class="form-label">Link Sumber Data</label>
                    <input type="text" name="link_data_source" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Link Sumber Data">
                </div>
        </div>
        <div class="modal-footer">
            <div class="d-grid mb-4">
                <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#addmore").click(function() {
            $("#examiner-list-head").append(`
                <li class="examiner-list">
                    <input type="text" class="form-control mb-2" id="formGroupExampleInput2" name="examiners[]" placeholder="Masukkan Nama Penguji">
                    <input type="button" class="inputRemove btn btn-sm btn-outline-danger w-100 mb-4" value="Remove"/>
                </li>
            `);
        });
        $('body').on('click', '.inputRemove', function() {
            $(this).closest('li.examiner-list').remove();
        });
    });
</script>