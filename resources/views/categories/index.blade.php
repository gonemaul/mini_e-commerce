@extends('layouts.main')

@section('content')
<script src="https://kit.fontawesome.com/1b48e60650.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
  <div class="p-4" style="background-color: #191c24;border-radius:0.5rem">
    <div class="d-flex justify-content-between mb-3">
      <h3 class="my-auto">Categories List</h3>
      <a class="btn btn-outline-primary" href="{{ Route('categories.create') }}" style="font-size:1rem;font-weight:500;align-items:center"><i class="fa-solid fa-plus"></i> Add Category</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="font-weight:600;"> # </th>
              <th class="text-center" style="font-weight:600;"> Category Name </th>
              <th class="text-center" style="font-weight:600;"> Action </th>
            </tr>
          </thead>
            <tbody>
              @foreach ($data as $item)  
                <tr>
                    <td class="text-center"> {{ $loop->iteration}} </td> 
                    <td> {{ $item->category_name }} </td> 
                    <td class="justify-content-center d-flex">
                          <a href="/categories/{{ $item->id }}/edit" class="btn btn-outline-warning" style="margin-right: 0.5rem;font-size:1rem"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                          <form action="/categories/{{ $item->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger" style="font-size:1rem"><i class="fa-solid fa-trash"></i> Delete</button>
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