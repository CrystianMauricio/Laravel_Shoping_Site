 @extends('layouts.app')
 @section('title','Member')
 @section('judul','Manage Member')
 @section('content')
 @if(Auth::user()->role== "admin")


 <div class="container">
    <div>
        <a href="" class="btn btn-primary" id="tambah" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add Member</a>
     </div>
        <div class="table-responsive">
                <table class="table table-striped mb-0">
                       <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Nama Member</th>
                                  <th>Email</th>
                                  <th>Roles</th>
                                  <th>Active</th>
                               </tr>
                                    </thead>
                                    @foreach($user as $users)
                                    <tbody>
                                        <tr>
                                            <td class="text-bold-500">{{ $users->id }}</td>
                                            <td>{{ $users->name }}</td>
                                            <td class="text-bold-500">{{ $users->email }}</td>
                                             <td class="text-bold-500">{{ $users->role }}</td>
                                             <td class="text-bold-500">{{ $users->active }}</td>
                                            <td>
                                                <a href="{{ route('member.allow', $users->id) }}" class="badge bg-primary">Allow</a>
                                                <a href="{{ route('member.delete', $users->id) }}" class="badge bg-danger">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                    </div>
        </div>
 </div>
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-centered modal-dialog-scrollable"role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Add Member
                </h5>
            </div>
        <div class="modal-body">
            <div class="row">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" name="email" placeholder="Email" required>
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" name="name" placeholder="Username" required>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" required>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" name="password_confirmation" placeholder="Confirm Password" required>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <input type="hidden" class="form-control form-control-xl" name="role" value="member">
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg">Add Member Data</button>
                </form>
            </div>
        </div>
</div>
@endif
@endsection