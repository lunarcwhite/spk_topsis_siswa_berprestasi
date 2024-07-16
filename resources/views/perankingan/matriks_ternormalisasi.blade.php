@extends('layouts.master')
@section('menuTitle')
    Matriks Ternormalisasi {{ $kelas->nama_kelas }}
@endsection
@section('content')
    <div class="row">
        <!-- table section -->
        <div class="col-md-12">
            <div class="white_shd full">
                <div class="table_section padding_infor_info">
                    <div class="table-responsive-sm">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    @foreach ($kriterias as $kriteria)
                                        <th>{{ $kriteria->kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswas as $no => $siswa)
                                    <tr>
                                        @csrf
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $siswa->nisn }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        @foreach ($kriterias as $index => $kriteria)
                                            <td>
                                                <input type="number" disabled value="{{ $matriks[$no][$index] }}"
                                                class="form-control">
                                            </td>
                                            @endforeach
                                    </tr>
                                @empty
                                    <h1>Data siswa kosong</h1>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
