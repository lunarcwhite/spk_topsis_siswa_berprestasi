@extends('layouts.master')
@section('menuTitle')
    Dashboard
@endsection
@section('content')
<div class="row column1">
    <div class="col-md-6 col-lg-4">
       <div class="full counter_section margin_bottom_30 yellow_bg">
          <div class="couter_icon">
             <div> 
                <i class="fa fa-user"></i>
             </div>
          </div>
          <div class="counter_no">
             <div>
                <p class="total_no">{{ $siswa }}</p>
                <p class="head_couter">Siswa</p>
             </div>
          </div>
       </div>
    </div>
    <div class="col-md-6 col-lg-4">
       <div class="full counter_section margin_bottom_30 blue1_bg">
          <div class="couter_icon">
             <div> 
                <i class="fa fa-users"></i>
             </div>
          </div>
          <div class="counter_no">
             <div>
                <p class="total_no">{{ $user }}</p>
                <p class="head_couter">Guru</p>
             </div>
          </div>
       </div>
    </div>
    <div class="col-md-6 col-lg-4">
       <div class="full counter_section margin_bottom_30 green_bg">
          <div class="couter_icon">
             <div> 
                <i class="fa fa-map-o"></i>
             </div>
          </div>
          <div class="counter_no">
             <div>
                <p class="total_no">{{ $kelas }}</p>
                <p class="head_couter">Kelas</p>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection