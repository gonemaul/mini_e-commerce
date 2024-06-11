@extends('layouts.main')

@section('content')
<script src="https://kit.fontawesome.com/1b48e60650.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <div class="p-4" style="background-color: #191c24;border-radius:0.5rem">
        <div class="status bg-warning p-3 mb-3" style="border-radius: 0.5rem;font-size:1rem;font-weight:600">
            <span>Status : </span>
            <span>Pending <i class="ms-3 fa-solid fa-hourglass-end ml-2"></i></span>
            <span class="d-block text-center">Please make the payment immediately !!!</span>
            <span class="d-block text-center">Make a payment before 11 Juni 2024</span>
        </div>
        <div class="info p-3">
            <div class="buyyer mb-3">
                <div class="title mb-1">
                    <i class="fa-solid fa-user mr-1"></i> Buyer Details
                </div>
                <div class="body ml-4">
                    <span class="d-block">{{ $data->user->username }}</span>
                    <span>{{ $data->user->email }}</span>
                </div>
            </div>
            <div class="shipping">
                <div class="title mb-1">
                    <i class="fa-solid fa-location-dot mr-1"></i>  Shipping address
                </div>
                <div class="body ml-4">
                    <span class="d-block">{{ $data->user->name }}</span>
                    <span class="d-block">085678428355</span>
                    Jalan Buntu Raya, RT 99 RW 19 Ds.Desaku, Bebek, Kediri ,Jawa Timur , 64157 
                </div>
            </div>
        </div>
        <div class="product-item ">
            @foreach ($data->orderItems as $item)  
                <div class="row mb-3 p-3 m-0" style="border-radius:0.5rem;background-color: #595d6aac;color: ">
                    <div class="col-md-12">
                        <div class="product_name mb-1" style="font-weight: 600;">{{ $item->product->product_name }}</div>
                        <div class="info d-flex justify-content-between mb-1">
                            <span class="badge badge-outline-success">{{ $item->product->category->category_name }}</span>
                            <span>{{ $item->quantity }} x</span>
                        </div>
                        <div class="price text-center">Rp. {{ number_format($item->product->price, 0, ',', '.') }}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="details-payment p-3">
            <div class="total-products">
                Total Product   : Rp. {{ number_format($data->total, 0, ',', '.') }}
            </div>
            <div class="delivery">
                Delivery : Rp. 10.000
            </div>
            <div class="pajak">
                Biaya Admin : Rp. 1.000
            </div>
            <div class="total-payment">
                Total Payment : Rp. {{ number_format($data->total, 0, ',', '.') }}
            </div>
            {{-- <div class="total-items">
                Total Items     : {{ $data->orderItems->count() }}
            </div> --}}
        </div>
        <a href="{{ Route('orderList') }}" class="ml-3 btn btn-primary">Back</a>
    </div>
</div>
@endsection