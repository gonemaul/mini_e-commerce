@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="p-4" style="background-color: #191c24;border-radius:0.5rem">
            <div class="title mb-5">
                <h4>Create Category</h4>
            </div>
            <form action="{{ Route('categories.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control" id="name" name="category_name" placeholder="Category Name" required autofocus>
                </div>
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="{{ Route('categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection