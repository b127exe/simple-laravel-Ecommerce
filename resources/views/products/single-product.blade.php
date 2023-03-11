@extends('layouts.layout_01')
@section('style')
    <style>
        .main-image
        {
            transition: all .5s linear;
        }
        .main-image:hover
        {
          transform: scale(1.2);
        }
    </style>
@endsection
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6">
                @php
                    $image = $product->file;
                    $files = explode('|', $image);
                @endphp
                <div class="d-flex justify-content-center" style="flex-direction: column;max-width: 480px;width: 100%;">
                    <div style="overflow: hidden;">
                        <img src="{{ url('uploads') }}/{{$files[0]}}" width="100%" class="main-image">
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        @foreach ($files as $img)
                            <img src="{{ url('uploads') }}/{{$img}}" width="100px" class="small-image">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-3">
                <h2 class="display-3">{{$product->title}}</h2>
                <p class="text-warning lead">${{$product->price}}</p>
                <p class="lead">
                  <strong>Category: </strong> 
                  @php
                      $category = DB::select('select * from categories where category_id = ?',[$product->category_id]);                     
                  @endphp
                  {{$category[0]->category_name}}
                </p>
                <strong>Detail:</strong>
                <p>&#8220;{{$product->shortDesc}}&#8221;</p>
                <hr>
                <strong>Description: </strong>
                <p>{{$product->longDesc}}</p>
                <a class="btn btn-primary" href="{{url('/add-cart')}}/{{$product->pid}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                      </svg>
                    Add to cart</a>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let mainImage = document.querySelector(".main-image");
        let gridImage = [...document.querySelectorAll(".small-image")];

        gridImage.forEach(element => {

            element.onclick = function() {
                mainImage.src = element.src;
            }

        });
    </script>
@endsection
