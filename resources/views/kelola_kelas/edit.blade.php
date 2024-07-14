<div class="modal fade" id="editKelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formEditKelas">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Kelas</label>
                        <input type="text" class="form-control" name="nama_kelas" id="nama_kelas"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Wali Kelas</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="">--> Pilih wali kelas <-- </option>
                                    @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="formConfirmation('Perbarui data kelas?')"
                    class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        async function getDataKelas(id) {
            document.getElementById('formEditKelas').reset();
            const url = `{{ url('dashboard/kelola_kelas/${id}/edit') }}`;
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }

                const json = await response.json();
                document.getElementById('nama_kelas').value = json.nama_kelas;
                if (json.user_id !== null) {
                    document.getElementById('user_id').value = json.user_id;
                }
                document.getElementById('formEditKelas').action = `{{ url('dashboard/kelola_kelas/${json.id}') }}`;
            } catch (error) {
                console.error(error.message);
            }
        }
    </script>
@endpush
