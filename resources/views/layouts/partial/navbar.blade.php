<div class="topbar">
    <nav class="navbar navbar-expand-lg navbar-light">
       <div class="full">
          <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
          <div class="right_topbar">
             <div class="icon_info">
                {{-- <ul>
                   <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                   <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                   <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li>
                </ul> --}}
                <ul class="user_profile_dd">
                   <li>
                      <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="{{ asset('images/layout_img/user.png') }}" alt="#" /><span class="name_user">{{ Auth::user()->username }}</span></a>
                      <div class="dropdown-menu">
                         <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                         <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault();formConfirmationId('#form-logout','Anda ingin keluar Aplikasi?')"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                      </div>
                   </li>
                </ul>
             </div>
          </div>
       </div>
    </nav>
    {{-- logout form --}}
    <form method="POST" action="{{ route('logout') }}" id="form-logout">
      @csrf
  </form>
 </div>