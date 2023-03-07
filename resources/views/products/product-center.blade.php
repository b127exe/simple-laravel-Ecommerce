@extends('layouts.layout_01')
@section('style')
    <style>
        img
        {
            transition: all .4s ease-out;
        }
        img:hover
        {
           transform: scale(1.2); 
        }
    </style>
@endsection
@section('content')
    <div class="container mt-3">
        <div class="row">
            @foreach ($products as $items)
                <div class="col mx-auto my-3">
                    <div class="card" style="width: 18rem;">
                        @php
                            $image = $items->file;
                            $singleImg = explode('|',$image);       
                        @endphp
                        <div style="overflow: hidden;">
                            <img src="{{url('uploads')}}/{{$singleImg[0]}}" style="height: 300px" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$items->title}}</h5>
                            <p class="lead text-warning">${{$items->price}}</p>
                            <p class="card-text">{{$items->shortDesc}}</p>
                            <a href="/add-cart/{{$items->pid}}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                  </svg>
                                Add to cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
