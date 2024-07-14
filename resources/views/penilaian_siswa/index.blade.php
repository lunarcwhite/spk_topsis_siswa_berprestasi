@extends('layouts.master')
@section('menuTitle')
    Penilian Siswa {{ $kelas }}
@endsection
@section('content')
    <div class="row">
        <!-- table section -->
        <div class="col-md-12">
            <div class="white_shd full">
                <div class="table_section padding_infor_info">
                    <div class="table-responsive-sm">
                        <form action="{{ route('penilaian_siswa.store') }}" method="post" id="formNilai">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        @foreach ($kriterias as $kriteria)
                                            <th>{{ $kriteria->kriteria }}</th>
                                        @endforeach
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($siswas as $no => $siswa)
                                        <tr>
                                            @csrf
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $siswa->nisn }}</td>
                                            <td>{{ $siswa->nama }}</td>
                                            @foreach ($kriterias as $kriteria)
                                                @php
                                                    $nilai = 0;
                                                    $nilai_siswa = $nilais
                                                        ->where('siswa_id', $siswa->id)
                                                        ->where('kriteria_id', $kriteria->id)
                                                        ->first();
                                                    if ($nilai_siswa !== null) {
                                                        $nilai = $nilai_siswa->nilai;
                                                    }
                                                @endphp
                                                <td>
                                                    <input type="number" name="nilai[]" value="{{ $nilai }}"
                                                        class="form-control">
                                                    <input type="hidden" name="kriteria_id[]" value="{{ $kriteria->id }}"
                                                        id="">
                                                        <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}"
                                                        id="">
                                                </td>
                                            @endforeach
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" onclick="formConfirmation('Simpan nilai {{ $siswa->nama }}')" class="btn btn-info">Simpan</button>
                                                </div>
                                            </td>
                        </form>
                        </tr>
                    @empty
                        <h1>Data siswa kosong</h1>
                        @endforelse
                        </tbody>
                        </table>
                        <hr />
                        <button class="btn btn-primary float-right" type="button" onclick="formConfirmation('Simpan semua nilai?')">Simpan Semua Nilai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
