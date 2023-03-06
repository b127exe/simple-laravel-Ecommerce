@extends('layouts.layout_01')
@section('content')
    <div class="container mt-3">
        <h2 class="display-4 text-center">All Trash Products</h2><hr>
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
                    @foreach ($Tproducts as $items)
                         <tr>
                            <td>{{$items->pid}}</td>
                            <td>{{$items->title}}</td>
                            <td>{{$items->shortDesc}}</td>
                            <td>{{$items->category_id}}</td>
                            <td>${{$items->price}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Options
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="{{url('/products/restore')}}/{{$items->pid}}">Restore</a></li>
                                      <li><a class="dropdown-item" href="{{url('/products/delete')}}/{{$items->pid}}">Delete</a></li>
                                    </ul>
                                  </div
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection