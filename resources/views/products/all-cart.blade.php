@extends('layouts.layout_01')
@section('style')
    <style>
        td , th {
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="container mt-3">
        @if (!is_null(session()->get('cart')))
        <h2 class="display-4 text-center">All Carts</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                        $tax = 10;
                        $shipping = 150;
                    @endphp
                    @foreach (session()->get('cart') as $id => $row)
                        <tr>
                            <td>{{ $row['title'] }}</td>
                            <td>
                                @php
                                    $image = $row['image'];
                                    $singleImg = explode('|', $image);
                                @endphp
                                <img src="{{ url('uploads') }}/{{ $singleImg[0] }}" width="100px"
                                    style="border-radius: 50%;height: 100px;">
                            </td>
                            <td>{{ $row['shortDesc'] }}</td>
                            <td width="10%"><input type="number" class="form-control" value="{{ $row['quantity'] }}"></td>
                            <td>${{ $row['price'] }}</td>
                            <td><a href="{{url('/remove-cart')}}/{{$id}}" class="text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                    </svg></a></td>
                        </tr>
                        @php
                            $total = $tax + $shipping + $total + $row['price'];
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div> 
        <div class="row">
            <div class="col-md-6">
                <h2>Cart Details</h2>
                <p>Sale taxes: ${{$tax}}</p> 
                <p>Shipping amount: ${{$shipping}}</p>
                <p>Total amount: ${{$total}}</p>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <a href="{{url('/remove-all-cart')}}" class="btn btn-warning">Empty Cart</a>
                </div>
            </div>
        </div>
        @else
         <h2 class="display-4 text-center">No Products in cart</h2>
        @endif
        <div class="my-3">
            <a href="/product-center" class="btn btn-primary">Continue Shopping</a>
        </div>
    </div>
@endsection
