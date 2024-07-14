@extends('layouts.master')
@section('menuTitle')
    @if ($nama_kelas !== null)
    Data Siswa {{ $nama_kelas->nama_kelas }}
    @else
    Data Siswa SDN Sukamulya 1 
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSiswa">
                        Tambah
                    </button>
                    <hr />
                    <div class="table-responsive-sm">
                        <table class="table table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>JK</th>
                                    <th>Tempat tanggal lahir</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswas as $no => $siswa)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $siswa->nisn }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $siswa->jenis_kelamin }}</td>
                                        <td>{{ $siswa->tempat_lahir }} {{ $siswa->tanggal_lahir }}</td>
                                        <td>{{ $siswa->alamat }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editSiswa" onclick="getDataSiswa('{{ $siswa->id }}')">
                                                    Edit
                                                </button>
                                                <form action="{{ route('kelola_siswa.destroy', $siswa->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="formConfirmation('Hapus data siswa?')">Hapus</button>
                                                </form>
                                            </div>
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
    @include('kelola_siswa.tambah')
    @include('kelola_siswa.edit')
@stop
@push('script')
    <script>
        function filterKelas() {
           let kelas = document.querySelector('#kelas').value;
           window.location.href = `{{ url('dashboard/kelola_siswa/${kelas}') }}`;
        }
    </script>
@endpush
