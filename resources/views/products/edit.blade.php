@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="p-4" style="background-color: #191c24;border-radius:0.5rem">
            <div class="title mb-5">
                <h4>Edit Category</h4>
            </div>
            <form action="/products/{{ $data->id }}" method="post">
                @method('put')
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required value="{{ $data->product_name }}">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="proce">Price</label>
                    <input type="text" class="form-control" id="proce" name="price" required value="{{ number_format($data->price, 0, ',', '.') }}">
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="text" class="form-control" id="stock" name="stock" required value="{{ $data->stock }}">
                </div>
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a  href="/products" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection