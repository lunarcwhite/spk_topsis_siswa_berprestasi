@extends('layouts.master')
@section('menuTitle')
Hasil Solusi Ideal Positif & Negatif {{ $kelas->nama_kelas }}
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
                                    <th></th>
                                    @foreach ($kriterias as $kriteria)
                                    <th>{{ $kriteria->kriteria }}</th> 
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>A+</td>
                                        @foreach ($positif as $item)
                                        <td>{{ $item }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>A-</td>
                                        @foreach ($negatif as $item)
                                        <td>{{ $item }}</td>
                                        @endforeach
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
@stop
