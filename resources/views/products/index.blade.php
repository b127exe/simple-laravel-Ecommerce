@extends('layouts.layout_01')
@section('content')
    <div class="container mt-3">
        @if ($products->isNotEmpty())
            <h2 class="display-4 text-center">All Products</h2>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $items)
                            <tr>
                                <td>{{ $items->pid }}</td>
                                <td>{{ $items->title }}</td>
                                <td>{{ $items->shortDesc }}</td>
                                <td>
                                    @php
                                        $category = DB::select('select * from categories where category_id = ?', [$items->category_id]);
                                    @endphp
                                    {{ $category[0]->category_name }}
                                </td>
                                <td>${{ $items->price }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Options
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ url('/products/single-product') }}/{{ $items->pid }}">View</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ url('/products/trash') }}/{{ $items->pid }}">Trash</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ url('/products/update') }}/{{ $items->pid }}">Update</a>
                                            </li>
                                        </ul>
                                    </div 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h2 class="display-3 text-center">No Products Here</h2>
        @endif
    </div>
@endsection
