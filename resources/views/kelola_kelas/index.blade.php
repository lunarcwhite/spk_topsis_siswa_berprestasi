@extends('layouts.master')
@section('menuTitle')
    Data Kelas
@endsection
@section('content')
    <div class="row">
        <!-- table section -->
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKelas">
                            Tambah
                        </button>
                    </div>
                </div>
                <div class="table_section padding_infor_info">
                    <div class="table-responsive-sm">
                        <table class="table table-stripped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kelas</th>
                                    <th>Wali Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kelass as $no => $kelas)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $kelas->nama_kelas }}</td>
                                        <td>
                                            @if ($kelas->user_id != null)
                                            <h6 class="text-success">{{ $kelas->user->username }}</h6>
                                            @else
                                                <h6 class="text-info">Belum memiliki wali kelas</h6>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editKelas" onclick="getDataKelas('{{ $kelas->id }}')">
                                                    Edit
                                                </button>
                                                <form action="{{ route('kelola_kelas.destroy', $kelas->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="formConfirmation('Hapus data kelas?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <h1>Data kelas kosong</h1>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('kelola_kelas.tambah')
    @include('kelola_kelas.edit')
@stop
