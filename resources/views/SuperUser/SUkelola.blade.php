@include('SuperUser.partials.navbar')

<section class="content">
    <header class="top-head container-fluid">
        <div class="headaja py-2">
            @yield('tittle')
        </div>
    </header>

    <div class="warper container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-header">
                        <h3> Community</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($komunitas as $community)
                    <div class="col-3 mx-3 mt-3">
                        <div class="card" style="width: 16rem;">
                            <div class="cardkomunitas bg-purple-800">
                                <h5 class="card-title text-center text-xl">{{ $community->nama_komunitas }}</h5>
                                <p class="card-text">{{ $community->description_komunitas }}</p>
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('superuser.edit.komunitas', ['id_komunitas'=> $community->id_komunitas]) }}" class="btn btnn border-black hover:bg-purple-900">Kelola Komunitas</a>
                                    </div>
                                    <div class="col">
                                        {{-- Assuming you have an attribute 'id_kegiatan' in your $community model --}}
                                        <a href="{{ route('superuser.kegiatan', ['id' => $community->id, 'id_komunitas' => $community->id_komunitas]) }}" class="btn btnn border-black hover:bg-purple-900">Kelola Kegiatan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <footer class="container-fluid footer">
        Copyright &copy; 2023 <a href="#" >@Konekin</a>
        <a href="#" class="pull-right scrollToTop"><i class="fa fa-chevron-up"></i></a>
    </footer>
</section>
