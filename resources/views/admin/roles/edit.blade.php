@extends('admin.master')

@section('title','Edit Role | ' . env('APP_NAME'))

@section('styles')

<style>
 ul {
     column-count: 2;
 }
</style>

@stop


@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Role</h1>

@if (session('msg'))
    <div class="alert alert-{{ session('type') }}">
    {{ session('msg') }}
    </div>
@endif

    @include('admin.errors')

<form action="{{ route('admin.roles.update' , $role->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('Put')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $role->name }}">
    </div>

    <label><input type="checkbox" id="check_all"> Select All</label> <br>
    <ul class="list-unstyled">
        @foreach ($abilities as $ability)
            <li><label><input  {{ $role->abilities->find($ability->id) ? 'checked' : '' }} type="checkbox" name="ability[]" value="{{ $ability->id }}"> {{ $ability->name }} </label></li>
        @endforeach
    </ul>


    <button class="btn btn-info px-5" >Update</button>

</form>

@stop

@section('scripts')
<script>
    $('#check_all').on('change', function() {
        $('input[type=checkbox]').prop('checked', $(this).prop('checked'));
    })
</script>
@stop
