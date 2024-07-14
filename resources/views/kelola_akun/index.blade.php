@extends('layouts.master')
@section('menuTitle')
    Data Akun
@endsection
@section('content')
    <div class="row">
        <!-- table section -->
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahAkun">
                            Tambah
                        </button>
                    </div>
                </div>
                <div class="table_section padding_infor_info">
                    <div class="table-responsive-sm">
                        <table class="table table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $no => $user)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->nama_role }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editAkun" onclick="getDataAkun('{{ $user->id }}')">
                                                    Edit
                                                </button>
                                                <form action="{{ route('kelola_akun.destroy', $user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="formConfirmation('Hapus data akun?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <h1>Data akun kosong</h1>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('kelola_akun.tambah')
    @include('kelola_akun.edit')
@stop
