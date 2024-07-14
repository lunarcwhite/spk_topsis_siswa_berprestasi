@extends('layouts.master')
@section('menuTitle')
    Dashboard
@endsection
@section('content')
<div class="row column1">
    <div class="col-md-6 col-lg-3">
       <div class="full counter_section margin_bottom_30 yellow_bg">
          <div class="couter_icon">
             <div> 
                <i class="fa fa-user"></i>
             </div>
          </div>
          <div class="counter_no">
             <div>
                <p class="total_no">2500</p>
                <p class="head_couter">Welcome</p>
             </div>
          </div>
       </div>
    </div>
    <div class="col-md-6 col-lg-3">
       <div class="full counter_section margin_bottom_30 blue1_bg">
          <div class="couter_icon">
             <div> 
                <i class="fa fa-clock-o"></i>
             </div>
          </div>
          <div class="counter_no">
             <div>
                <p class="total_no">123.50</p>
                <p class="head_couter">Average Time</p>
             </div>
          </div>
       </div>
    </div>
    <div class="col-md-6 col-lg-3">
       <div class="full counter_section margin_bottom_30 green_bg">
          <div class="couter_icon">
             <div> 
                <i class="fa fa-cloud-download"></i>
             </div>
          </div>
          <div class="counter_no">
             <div>
                <p class="total_no">1,805</p>
                <p class="head_couter">Collections</p>
             </div>
          </div>
       </div>
    </div>
    <div class="col-md-6 col-lg-3">
       <div class="full counter_section margin_bottom_30 red_bg">
          <div class="couter_icon">
             <div> 
                <i class="fa fa-comments-o"></i>
             </div>
          </div>
          <div class="counter_no">
             <div>
                <p class="total_no">54</p>
                <p class="head_couter">Comments</p>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection