@extends('layouts.master')
@section('menuTitle')
    @if ($nama_kelas !== null)
    Hasil Akhir Siswa Siswa {{ $nama_kelas->nama_kelas }}
    @else
    Hasil Akhir Siswa SDN Sukamulya 1 
    @endif
@endsection
@section('content')
    <div class="row">
        <!-- table section -->
        <div class="col-md-12">
            <div class="white_shd full">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Kelas</label>
                            <select class="form-control" id="kelas" name="kelas" onchange="filterKelas()">
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
                    </div>
                </div>
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
@push('script')
    <script>
        function filterKelas() {
           let kelas = document.querySelector('#kelas').value;
           window.location.href = `{{ url('dashboard/hasil_akhir/${kelas}') }}`;
        }
    </script>
@endpush
