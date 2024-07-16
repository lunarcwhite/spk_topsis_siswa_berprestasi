<div class="modal fade" id="tambahSubKriteria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah SubKriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kelola_sub_kriteria.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Batas atas nilai sub kriteria</label>
                        <input type="number" class="form-control" name="batas_atas" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                            <input type="hidden" readonly class="form-control" name="kriteria_id" value="{{ $kriteria->id }}" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Batas bawah nilai sub kriteria</label>
                        <input type="number" class="form-control" name="batas_bawah" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nilai dari subkriteria ini</label>
                        <input type="number" class="form-control" name="nilai" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="formConfirmation('Tambah subkriteria baru?')"
                    class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
