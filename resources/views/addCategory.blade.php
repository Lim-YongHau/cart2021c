@extends('layout')
@section('content')

<div class="row justify-content-center">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">

    <br><br>
    <h3>Add New Category</h3>
    <form action="{{route('addCategory')}}" method="post">
        @csrf
        <label for="addCategory"></label>
        <input type="text" class="form-control" id="categoryName" name="categoryName" required>
        <button type="submit" class="btn btn-primary">Add New </button>
    </form>
    <br><br>
    </div>

    <div class="col-sm-3"></div> 

</div>
@endsection