@extends('admin.master')

@section('title','Dashboard | ' . env('APP_NAME'))

@section('content')

@section('styles')

   <style>
    ul {
        column-count: 2;
    }
   </style>

@stop

<h1 class="h3 mb-4 text-gray-800">Add New Category</h1>

@include('admin.errors')

<form action="{{ route('admin.roles.store') }}" method="POST">
      @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" class="form-control" />
        </div>

        <label><input type="checkbox" id="check_all"> Select All</label> <br>
    <ul class="list-unstyled">
        @foreach ($abilities as $ability)
            <li><label><input type="checkbox" name="ability[]" value="{{ $ability->id }}"> {{ $ability->name }} </label></li>
        @endforeach
    </ul>

        <button class="btn btn-success px-5" >Add</button>

</form>

@stop

@section('scripts')
{{-- <script> // my script
    $('#check_all').click(function(event) {
    if (this.checked) {
      $(':checkbox').prop('checked', true);
    } else {
      $(':checkbox').prop('checked', false);
    }
  });
</script> --}}

<script> // alqumpoz scirpt
    $('#check_all').on('change', function() {
        $('input[type=checkbox]').prop('checked', $(this).prop('checked'));
    })
</script>
@stop
