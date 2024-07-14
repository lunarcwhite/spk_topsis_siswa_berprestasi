<div class="modal fade" id="editSubKriteria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah SubKriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formEditSubKriteria" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="batas_atas">Batas maksamil nilai sub kriteria</label>
                        <input type="number" class="form-control" name="batas_atas" id="batas_atas"
                            aria-describedby="emailHelp">
                            <input type="hidden" readonly class="form-control" name="kriteria_id" value="{{ $kriteria->id }}" id="kriteria_id"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="batas_bawah">Batas minimal nilai sub kriteria</label>
                        <input type="number" class="form-control" name="batas_bawah" id="batas_bawah"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="nilai">Nilai dari subkriteria ini</label>
                        <input type="number" class="form-control" name="nilai" id="nilai"
                            aria-describedby="emailHelp">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="formConfirmation('Perbarui data subkriteria?')"
                    class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        async function getDataSubKriteria(id) {
            document.getElementById('formEditKelas').reset();
            const url = `{{ url('dashboard/kelola_sub_kriteria/${id}/edit') }}`;
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }

                const json = await response.json();
                document.getElementById('batas_atas').value = json.batas_atas;
                document.getElementById('batas_bawah').value = json.batas_bawah;
                document.getElementById('nilai').value = json.nilai;
                document.getElementById('formEditSubKriteria').action = `{{ url('dashboard/kelola_sub_kriteria/${json.id}') }}`;
            } catch (error) {
                console.error(error.message);
            }
        }
    </script>
@endpush
