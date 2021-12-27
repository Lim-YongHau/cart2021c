@extends('layout')
@section('content')

<div class="row justify-content-center">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">

        <br><br>
        <h3>Add New Product</h3>
        <form action="{{route('addProduct')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" id="productName" name="productName" required>

            <label for="productDescription">Description</label>
            <input type="text" class="form-control" id="productDescription" name="productDescription" required>

            <label for="productPrice">Price</label>
            <input type="text" class="form-control" id="productPrice" name="productPrice" required>

            <label for="productQuantity">Quantity</label>
            <input type="text" class="form-control" id="productQuantity" name="productQuantity" required>

            <label for="productImage">Image</label>
            <input type="file" class="form-control" id="productImage" name="productImage" required>

            <label for="categoryID">Category</label>
            <select name="categoryID" id="categoryID" class="form-control">

                @foreach($categoryID as $category)  

                
                <option value="{{$category->id}}">{{$category->name}}</option>

                @endforeach

            </select>
            <br>
            <button type="submit" class="btn btn-primary">Add New </button>
        </form>
        <br><br>
    </div>

    <div class="col-sm-3"></div>

</div>
@endsection