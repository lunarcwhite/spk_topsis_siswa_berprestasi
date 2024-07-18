<nav id="sidebar">
    <div class="sidebar_blog_1">
        <div class="sidebar-header">
            <div class="logo_section">
                <a href="{{ route('dashboard') }}"><img class="logo_icon img-responsive"
                        src="{{ asset('images/layout_img/user.png') }}" alt="#" /></a>
            </div>
        </div>
        <div class="sidebar_user_info">
            <div class="icon_setting"></div>
            <div class="user_profle_side">
                <div class="user_img"><img class="img-responsive" src="{{ asset('images/layout_img/user.png') }}"
                        alt="#" /></div>
                <div class="user_info">
                    <h6>{{ Auth::user()->username }}</h6>
                    <p><span class="online_animation"></span> Online</p>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar_blog_2">
        <ul class="list-unstyled components">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard yellow_color"></i>
                    <span>Dashboard</span></a></li>
            @can('admin')
                <li><a href="{{ route('kelola_akun.index') }}"><i class="fa fa-cog yellow_color"></i> <span>Data
                            Akun</span></a></li>
                <li><a href="{{ route('kelola_kelas.index') }}"><i class="fa fa-clock-o orange_color"></i> <span>Data
                            Kelas</span></a></li>
                <li><a href="{{ route('kelola_siswa.index') }}"><i class="fa fa-diamond purple_color"></i> <span>Data
                            Siswa</span></a></li>
                <li><a href="{{ route('kelola_kriteria.index') }}"><i class="fa fa-table purple_color2"></i> <span>Data
                            Kriteria</span></a></li>
            @endcan
            @can('Wali Kelas')
                <li><a href="{{ route('penilaian_siswa.index') }}"><i class="fa fa-object-group blue2_color"></i> <span>Penilaian Siswa</span></a></li>
                <li class="active">
                    <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                            class="fa fa-clone yellow_color"></i> <span>Perankingan</span></a>
                    <ul class="collapse list-unstyled" id="additional_page">
                        <li>
                            <a href="{{ route('perankingan.perankinganTernormalisasi') }}">> <span>Matriks Ternormalisasi</span></a>
                        </li>
                        <li>
                            <a href="{{ route('perankingan.perankinganTernormalisasiTerbobot') }}">> <span>Matriks Ternormalisasi Terbobot</span></a>
                        </li>
                        {{-- <li>
                            <a href="login.html">> <span>Solusi Ideal Positif</span></a>
                        </li>
                        <li>
                            <a href="404_error.html">> <span>Solusi Ideal Negatif</span></a>
                        </li> --}}
                        <li>
                            <a href="{{ route('perankingan.nilaiPreferensi') }}">> <span>Jarak Solusi Ideal Positif, Jarak Solusi Negatif dan Nilai
                                    Preferensi</span></a>
                        </li>
                        <li>
                            <a href="{{ route('perankingan.hasil_akhir') }}">> <span>Peringkat</span></a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('Kepala Sekolah')
            <li><a href="{{ route('monitoring.hasil_akhir') }}"><i class="fa fa-paper-plane red_color"></i> <span>Hasil Akhir</span></a></li>    
            @endcan
        </ul>
    </div>
</nav>
