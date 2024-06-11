@extends('layouts.main')

@section('content')
<script src="https://kit.fontawesome.com/1b48e60650.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <div class="p-4" style="background-color: #191c24;border-radius:0.5rem">
        <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
                <tr>
                <th class="text-center" style="font-weight:600;"> # </th>
                <th class="text-center" style="font-weight:600;"> User </th>
                <th class="text-center" style="font-weight:600;"> Total </th>
                <th class="text-center" style="font-weight:600;"> Status </th>
                <th class="text-center" style="font-weight:600;"> Action </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)    
                    <tr>
                        <td class="text-center">{{ $loop->iteration}}</td>
                        <td class="text-center">{{ $item->user->name }}</td>
                        <td class="text-center"> Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @if ($item->status == 'pending')
                                <label class="badge badge-outline-warning"><i class="fa-solid fa-hourglass-end"></i> Pending</label>
                            @elseif ($item->status == 'in-progress')
                                <label class="badge badge-outline-primary"><i class="fa-solid fa-truck"></i> In Proccess</label>
                            @elseif ($item->status == 'success')
                                <label class="badge badge-outline-success"><i class="fa-solid fa-circle-check"></i> Success</label>
                            @elseif ($item->status == 'cancelled')
                                <label class="badge badge-outline-danger"><i class="fa-solid fa-circle-xmark"></i> Cancelled</label>
                            @else
                                
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="orders/detail/{{ $item->id }}" class="btn btn-outline-info"><i class="fa-solid fa-eye"></i> Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection