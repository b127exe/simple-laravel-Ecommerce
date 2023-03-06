@extends('layouts.layout_01')
@section('content')
@if (session()->has('status'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{session()->get('status')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="display-4 text-center">Add Product</h2>
                <hr>
                <form action="{{url('/products/insert-store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Short Description</label>
                        <input type="text" class="form-control" name="shortDesc">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Long Description</label>
                        <textarea name="longDesc" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        @php
                            $category = DB::table('categories')->get();
                        @endphp
                        <select name="category" class="form-control">
                            <option selected>---select---</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->category_id }}">{{ $item->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" name="price">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thumbnails</label>
                        <input type="file" multiple class="form-control" name="image[]">
                    </div>  
                    <div class="d-grid my-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
@endsection
