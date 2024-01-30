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
                        <h3> Users</h3>
                    </div>

                    </div><br />
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                {{-- <th>NO</th> --}}
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Birdate</th>
                                <th>Role</th>
                                <th>created_at</th>
                                <th>updated_at</th>

                            </tr>
                       @foreach ($User as $U)
                            <tr>
                                {{-- <td>{{ $loop->iteration}}</td> --}}
                                <td>{{ $U->id }}</td>
                                <td>{{ $U->name }}</td>
                                <td>{{ $U->email }}</td>
                                <td>{{ $U->Birthdate }}</td>
                                <td>{{ $U->role }}</td>
                                <td>{{ $U->created_at }}</td>
                                <td>{{ $U->updated_at }}</td>
                                <td>
                                    {{-- <a href="{{ route('user.edit',['id'=> $U->id]) }}" class="btn btn-promary"><i class="fas fa-pen">Edit</i></a> --}}
                                    <a  data-toggle="modal" data-target="#modal-hapus{{ $U->id }}" class="btn btn-denger"><i class="fas fa-trash-alt">EDIT</i></a>
                                    <a  data-toggle="modal" data-target="#modal-hapus{{ $U->id }}" class="btn btn-denger"><i class="fas fa-trash-alt">Hapus</i></a>
                                </td>
                            </tr>
                       @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- Warper Ends Here (working area) -->


      <footer class="container-fluid footer">
          Copyright &copy; 2023 <a href="#" >@Konekin</a>
          <a href="#" class="pull-right scrollToTop"><i class="fa fa-chevron-up"></i></a>
      </footer>


  </section>


