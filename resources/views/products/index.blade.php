@extends('layouts.main')

@section('content')
<script src="https://kit.fontawesome.com/1b48e60650.js" crossorigin="anonymous"></script>
    <div class="content-wrapper">
        <div class="p-4" style="background-color: #191c24;border-radius:0.5rem">
            <div class="d-flex justify-content-between mb-3">
                <h3 class="my-auto">Products List</h3>
                <a class="btn btn-outline-primary btn-icon-text py-auto text-center" href="{{ Route('products.create') }}" style="font-size:1rem;font-weight:500"><i class="fa-solid fa-plus"></i> Add Product</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center" style="font-weight:600;"> # </th>
                      <th class="text-center" style="font-weight:600;"> Product Name </th>
                      <th class="text-center" style="font-weight:600;"> Category </th>
                      <th class="text-center" style="font-weight:600;"> Price </th>
                      <th class="text-center" style="font-weight:600;"> Stock </th>
                      <th class="text-center" style="font-weight:600;"> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)  
                      <tr>
                        <td class="text-center"> {{ $loop->iteration}} </td> 
                        <td> {{ $item->product_name }} </td> 
                        <td class="text-center"> {{ $item->category->category_name }} </td> 
                        <td class="text-center">Rp. {{ number_format($item->price, 0, ',', '.') }} </td> 
                        <td class="text-center"> {{ $item->stock }} </td> 
                        <td class="justify-content-center d-flex">
                              <a href="/products/{{ $item->id }}/edit" class="btn btn-outline-warning" style="margin-right: 0.5rem;font-size:1rem"><i class="mdi mdi-pencil"></i> Edit</a>
                              <form action="/products/{{ $item->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger" style="font-size:1rem"><i class="mdi mdi-delete"></i> Delete</button>
                              </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection