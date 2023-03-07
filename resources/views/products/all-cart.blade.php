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
        <h2 class="display-4 text-center">All Carts</h2>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
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
                            <td><input type="number" class="form-control w-25" value="{{ $row['quantity'] }}"></td>
                            <td>${{ $row['price'] }}</td>
                            <td><a href="" class="text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                    </svg></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
