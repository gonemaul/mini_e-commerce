@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="p-4" style="background-color: #191c24;border-radius:0.5rem">
        <div class="title mb-5">
            <h4>Edit Category</h4>
        </div>
        <form action="/categories/{{ $data->id }}" method="post">
            @method('put')
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control" id="name" name="category_name" placeholder="Category Name" value="{{ $data->category_name }}" required>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
</div>
@endsection