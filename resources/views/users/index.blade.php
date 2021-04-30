@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Add User</h3><a class="float-right btn btn-dark" data-toggle="modal"
                                href="#userAddModal"><i class="fa fa-plus"></i> Add New User</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->is_admin == 1)
                                            <p>Admin</p>
                                            @elseif($user->is_admin == 2)
                                            <p>Cashire</p>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-info btn-sm" data-toggle="modal"
                                                    href="#userEditModal{{ $user->id }}"><i class="fa fa-edit"></i>
                                                    Edit</a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                    href="#userDeleteModal{{ $user->id }}"><i class="fa fa-trash"></i>
                                                    Delete</a>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- edit user modal --}}
                                    <div id="userEditModal{{ $user->id }}" class="modal fade right">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="float-left">Edit User</h3><button class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="">Name</label>
                                                            <input type="text" name="name" class="form-control"
                                                                value="{{ $user->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Email</label>
                                                            <input type="email" name="email" class="form-control"
                                                                value="{{ $user->email }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Password</label>
                                                            <input type="password" name="password" class="form-control"
                                                                readonly value="{{ $user->password }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Role</label>
                                                            <select name="is_admin" class="form-control" id="">
                                                                <option value="">-Select User-</option>
                                                                <option value="1" @if($user->is_admin == 1) selected
                                                                    @endif>Admin</option>
                                                                <option value="2" @if($user->is_admin == 2) selected
                                                                    @endif>Cashire</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-block">Update
                                                                User</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- delete user modal --}}
                                    <div id="userDeleteModal{{ $user->id }}" class="modal fade right">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="float-left">Delete User</h3><button class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('users.destroy', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <p class="text-center">Are you sure you want to delete this
                                                            {{ $user->name }} ?</p>

                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button class="btn btn-default"
                                                                data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Search User</h3>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- add user modal --}}
<div id="userAddModal" class="modal fade right">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="float-left">Add User</h3><button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="is_admin" class="form-control" id="">
                            <option value="">-Select User-</option>
                            <option value="1">Admin</option>
                            <option value="2">Cashire</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .card-header h3 {
        font-weight: bolder;
        text-transform: uppercase;
        font-size: 1.3rem;
    }

    .modal-header h3 {
        font-weight: bolder;
        text-transform: uppercase;
        font-size: 1.3rem;
    }

    .modal.right .modal-dialog {
        top: 0px;
        right: 0px;
        margin-right: 17vh;
    }

    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }
</style>
@endsection
