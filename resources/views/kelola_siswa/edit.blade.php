<div class="modal fade" id="editSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formEditSiswa">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Kelas</label>
                        <select class="form-control" name="kelas_id" id="kelas_id">
                            @if ($nama_kelas !== null)
                                <option value="{{ $nama_kelas->id }}" selected>{{ $nama_kelas->nama_kelas }}</option>
                            @else
                                <option>--> Pilih Kelas <-- </option>
                            @endif
                            @foreach ($kelass as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">NISN Siswa</label>
                        <input type="text" class="form-control" name="nisn" id="nisn"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Siswa</label>
                        <input type="text" class="form-control" name="nama" id="nama"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                            <option>--> Pilih Jenis Kelamin <-- </option>
                            <option value="L"">Laki - Laki</option>
                            <option value="P"">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <textarea name="alamat" class="form-control" cols="30" rows="10" id="alamat"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="formConfirmation('Perbarui data siswa?')"
                    class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        async function getDataSiswa(id) {
            document.getElementById('formEditKelas').reset();
            const url = `{{ url('dashboard/kelola_siswa/${id}/edit') }}`;
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }

                const json = await response.json();
                document.getElementById('nisn').value = json.nisn;
                document.getElementById('jenis_kelamin').value = json.jenis_kelamin;
                document.getElementById('nama').value = json.nama;
                document.getElementById('alamat').value = json.alamat;
                document.getElementById('tempat_lahir').value = json.tempat_lahir;
                document.getElementById('tanggal_lahir').value = json.tanggal_lahir;
                document.getElementById('kelas_id').value = json.kelas_id;

                document.getElementById('formEditSiswa').action = `{{ url('dashboard/kelola_siswa/${json.id}') }}`;
            } catch (error) {
                console.error(error.message);
            }
        }
    </script>
@endpush
