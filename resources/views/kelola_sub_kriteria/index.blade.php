@extends('layouts.master')
@section('menuTitle')
    Data Subkriteria dari Kriteria {{ $kriteria->kriteria }}
@endsection
@section('content')
    <div class="row">
        <!-- table section -->
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <a href="{{ route('kelola_kriteria.index') }}" class="btn btn-info float-right">Kembali</a>
                    <div class="heading1 margin_0">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSubKriteria">
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
                                    <th>Subkriteria</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subKriterias as $no => $subKriteria)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $subKriteria->batas_atas }} - {{ $subKriteria->batas_bawah }}</td>
                                        <td>{{ $subKriteria->nilai }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editSubKriteria"
                                                    onclick="getDataSubKriteria('{{ $subKriteria->id }}')">
                                                    Edit
                                                </button>
                                                <form action="{{ route('kelola_sub_kriteria.destroy', $subKriteria->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="formConfirmation('Hapus data subkriteria?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <h1>Data subkriteria kosong</h1>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('kelola_sub_kriteria.tambah')
    @include('kelola_sub_kriteria.edit')
@stop

