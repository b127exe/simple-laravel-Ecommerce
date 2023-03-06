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
                <h2 class="display-4 text-center">Edit Product</h2>
                <hr>
                <form action="{{url('/products/update-store')}}/{{$prod->pid}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{$prod->title}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Short Description</label>
                        <input type="text" class="form-control" name="shortDesc" value="{{$prod->shortDesc}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Long Description</label>
                        <textarea name="longDesc" rows="2" class="form-control">{{$prod->longDesc}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        @php
                            $category = DB::table('categories')->get();
                        @endphp
                        <select name="category" class="form-control">
                            @foreach ($category as $item)
                                <option value="{{ $item->category_id }}" @if ($item->category_id == $prod->category_id)
                                    selected
                                @endif>{{ $item->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" value="{{$prod->price}}">
                    </div>
                    <hr>
                     <input type="text" name="oldImg" value="{{$prod->file}}" hidden>
                     <div class="mb-3">
                        <label class="form-label">Old Thumbnails</label>
                        <div class="d-flex justify-content-between">
                            @php
                                $image = $prod->file;
                                $files = explode('|',$image);
                            @endphp
                            @foreach ($files as $img)
                                <img src="{{url('uploads')}}/{{$img}}" width="100px">
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Thumbnails</label>
                        <input type="file" multiple class="form-control" name="Newimage[]">
                    </div>  
                    <div class="d-grid my-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
@endsection
