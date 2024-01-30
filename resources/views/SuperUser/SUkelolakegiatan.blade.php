@include('SuperUser.partials.navbar')

<section class="content">

    <header class="top-head container-fluid">
        <div class="headaja py-2">
            @yield('tittle')
        </div>
    </header>
    <!-- Header Ends -->

    <div class="warper container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-header">
                        <h3> Kelola kegiatan</h3>
                    </div>

                    {{-- <a href="{{ route('superuser.create.kegiatan') }}" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-plus"></span> Buat Kegiatan Baru
                    </a> --}}
                    <br /><br />
                    <div class="alert alert-success" role="alert"></div><br />
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>ID kegiatan</th>
                                <th>Nama kegiatan</th>
                                <th>Detail Kegiatan </th>
                                <th>tanggal kegiatan </th>
                                <th>Aksi</th>
                            </tr>

                            @if ($komunitass)
                                @foreach($kegiatan as $K)
                                    @if ($K->id_komunitas == $komunitass->id_komunitas)
                                        <tr>
                                            <td>{{ $K->id_kegiatan }}</td>
                                            <td>{{ $K->nama_kegiatan }}</td>
                                            <td>{{ $K->detail_kegiatan }}</td>
                                            <td>{{ $K->tgl_kegiatan }} | {{ $K->jam_kegiatan }}</td>
                                            <td>
                                                <form action="{{ route('superuser.edit.kegiatan', ['id_komunitas' => $K->id_komunitas]) }}" method="get" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm btn-edit" onclick="return confirm('Apakah yakin ingin mengedit?');">Edit</button>
                                                </form>
                                                <form action="{{ route('superuser.hapus.kegiatan', ['id_komunitas' => $K->id_komunitas]) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Apakah yakin ingin menghapus?' );">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">No komunitas found</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Warper Ends Here (working area) -->

    <footer class="container-fluid footer">
        Copyright &copy; 2023 <a href="#">@Konekin</a>
        <a href="#" class="pull-right scrollToTop"><i class="fa fa-chevron-up"></i></a>
    </footer>

</section>
