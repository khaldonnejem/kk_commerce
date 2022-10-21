@extends('admin.master')

@section('title','Roles | ' . env('APP_NAME'))

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="h3  text-gray-800">All Roles</h1>
        <a class="btn btn-success w-25" href="{{ route('admin.roles.create') }}">Add New</a>


    </div>

@if (session('msg'))
    <div class="alert alert-{{ session('type') }}">
    {{ session('msg') }}
    </div>
@endif


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{  $role->created_at ? $role->created_at->diffForHumans() : '' }}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.roles.edit',$role->id) }}" ><i class="fas fa-edit">
                            </i></a>

                            <form class="d-inline" action="{{ route('admin.roles.destroy',$role->id) }}" method="POST">
                                @csrf
                                @method('delete')

                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')"><i class="fas fa-trash"></i></button>
                            </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $roles->links() }}

@stop
