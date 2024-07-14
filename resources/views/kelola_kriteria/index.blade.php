@extends('layouts.master')
@section('menuTitle')
    Data Kriteria
@endsection
@section('content')
    <div class="row">
        <!-- table section -->
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKriteria">
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
                                    <th>Kode</th>
                                    <th>Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kriterias as $no => $kriteria)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $kriteria->kode_kriteria }}</td>
                                        <td>{{ $kriteria->kriteria }}</td>
                                        <td>{{ $kriteria->bobot }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('kelola_sub_kriteria.index', $kriteria->id) }}" class="btn btn-secondary">Subkriteria</a>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editKriteria" onclick="getDataKriteria('{{ $kriteria->id }}')">
                                                    Edit
                                                </button>
                                                <form action="{{ route('kelola_kriteria.destroy', $kriteria->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="formConfirmation('Hapus data kriteria?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <h1>Data kriteria kosong</h1>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('kelola_kriteria.tambah')
    @include('kelola_kriteria.edit')
@stop
