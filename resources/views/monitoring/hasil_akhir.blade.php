@extends('layouts.master')
@section('menuTitle')
Hasil Akhir Siswa SDN Sukamulya 1
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
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Nilai Preferensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ranking as $no => $rank)
                                    @php
                                        $siswa = $siswas->where('id', $rank[0])->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $siswa->nisn }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $siswa->kelas->nama_kelas }}</td>
                                        <td>
                                            {{ $rank[1] }}
                                        </td>
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
    <!-- Modal -->
@stop
@push('script')
    <script>
        function filterKelas() {
            let kelas = document.querySelector('#kelas').value;
            window.location.href = `{{ url('dashboard/hasil_akhir/${kelas}') }}`;
        }
    </script>
@endpush
