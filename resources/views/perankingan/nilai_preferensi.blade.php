@extends('layouts.master')
@section('menuTitle')
    Hasil Solusi Ideal Positif & Negatif Serta Nilai Preferensi {{ $kelas->nama_kelas }}
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
                                    <th>Di+</th>
                                    <th>Di-</th>
                                    <th>Vi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswas as $no => $siswa)
                                    <tr>
                                        @csrf
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $siswa->nisn }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        @foreach ($solusiIdeal[$no] as $index => $solusi)
                                            <td>
                                                <input type="number" disabled value="{{ $solusi }}"
                                                class="form-control">
                                            </td>
                                        @endforeach
                                        <td><input type="number" disabled value="{{ $nilaiPreferensi[$no] }}"
                                            class="form-control"></td>
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
