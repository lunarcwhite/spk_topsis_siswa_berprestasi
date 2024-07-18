@extends('layouts.master')
@section('menuTitle')
Hasil Akhir Siswa Siswa {{ $nama_kelas->nama_kelas }}
@endsection
@section('content')
    <div class="row">
        <!-- table section -->
        <div class="col-md-12">
            <div class="white_shd full">
                <div class="table_section padding_infor_info">
                    <div class="table-responsive-sm">
                        <table class="table table-hover" id="dataTableWithExport">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Nilai Preferensi</th>
                                    <th>Ranking</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $peringkat = 1;
                                @endphp
                                @forelse ($perankingan as $no => $ranking)
                                @php
                                    $siswa = $siswas->where('id', $no)->first();
                                @endphp
                                    <tr>
                                        <td>{{ $peringkat }}</td>
                                        <td>{{ $siswa->nisn }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>
                                            {{ $ranking }}
                                        </td>
                                        <td>{{ $peringkat }}</td>
                                    </tr>
                                @php
                                    $peringkat = $peringkat + 1;
                                @endphp
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
    <!-- Modal -->
@stop
