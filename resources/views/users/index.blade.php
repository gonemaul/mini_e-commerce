@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center" style="font-weight:600;"> Profile </th>
                  <th class="text-center" style="font-weight:600;"> Name </th>
                  <th class="text-center" style="font-weight:600;"> Username </th>
                  <th class="text-center" style="font-weight:600;"> Email </th>
                  <th class="text-center" style="font-weight:600;"> Role </th>
                  <th class="text-center" style="font-weight:600;"> Status </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)  
                  <tr>
                    @if ($item->profile_image)
                      <td class="text-center"> <img src="{{ asset('storage/' . $item->profile_image) }}"> </td>
                    @else
                      <td class="text-center"> <img src="https://ui-avatars.com/api/?name={{ $item->username }}&color=7F9CF5&background=EBF4FF"> </td>
                    @endif
                    <td> {{ $item->name }} </td> 
                    <td> {{ $item->username }} </td> 
                    <td> {{ $item->email }} </td>
                    @if($item->is_admin)
                      <td class="text-center"> <label class="badge badge-outline-primary">Administrator</label> </td>
                    @else
                      <td class="text-center"> <label class="badge badge-outline-warning">User</label> </td>
                    @endif
                    <td class="text-center"> <label class="badge badge-outline-success">Active</label> </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection