@extends('layouts.app')

@section('content')
<h1>Order #{{ $order->id }}</h1>
<p><strong>Customer:</strong> {{ $order->customer_name }}</p>
<p><strong>Status:</strong> <span class="badge
    @if($order->status == 'PENDING') bg-warning
    @elseif($order->status == 'PROCESSING') bg-primary
    @elseif($order->status == 'SHIPPED') bg-info
    @elseif($order->status == 'DELIVERED') bg-success
    @elseif($order->status == 'CANCELED') bg-danger
    @endif">{{ $order->status }}</span></p>

<h3>Items</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
    @foreach($order->items as $item)
        <tr>
            <td>{{ $item->product_name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>${{ $item->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@if($order->status !== 'CANCELED')
<div class="mt-3 mb-3">
    <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}">
        @csrf
        <div class="input-group w-50">
            <select name="status" class="form-select">
                <option value="PENDING" {{ $order->status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                <option value="PROCESSING" {{ $order->status == 'PROCESSING' ? 'selected' : '' }}>PROCESSING</option>
                <option value="SHIPPED" {{ $order->status == 'SHIPPED' ? 'selected' : '' }}>SHIPPED</option>
                <option value="DELIVERED" {{ $order->status == 'DELIVERED' ? 'selected' : '' }}>DELIVERED</option>
            </select>
            <button type="submit" class="btn btn-primary">Update Status</button>
        </div>
    </form>
</div>
@endif
@if($order->status === 'PENDING')
<form method="POST" action="{{ route('orders.cancel', $order->id) }}">
    @csrf
    <button type="submit" class="btn btn-danger">Cancel Order</button>
</form>
@endif

@endsection
