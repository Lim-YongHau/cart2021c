@extends('layout')
@section('content')


<div class="container">

    <div class="row">
        @foreach($products as $product)
        <div class="col-sm-4 mt-3 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <img src="{{asset('images/')}}/{{$product->image}}" alt="" width="80%" class="img-fluid">
                    <div class="card-heading">Description: {{$product->description}}</div>
                    <div class="card-heading ">RM {{$product->price}}</div>

                    <a href="{{ route('product.detail', ['id' => $product->id]) }}" style="float:right" class="btn btn-warning btn-xs text-dark">Detail</a>
                    <button style="float:right" class="btn btn-danger btn-xs mr-2">Add to Cart</button>
                </div>
            </div>
        </div>

        @endforeach

        
    </div>

    {{ $products->links() }}
   

    
</div>

@endsection