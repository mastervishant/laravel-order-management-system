@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Orders</h1>
    <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#createForm">Create Order</button>
</div>

<div class="collapse mb-4" id="createForm">
    <div class="card card-body">
        <form method="POST" action="{{ route('orders.create') }}">
            @csrf
            <div class="mb-3">
                <label>Customer Name</label>
                <input type="text" name="customer_name" class="form-control" required>
            </div>
            <div id="items">
                <div class="mb-3 item-row">
                    <label>Product</label>
                    <input type="text" name="items[0][product_name]" class="form-control mb-1" placeholder="Product Name" required>
                    <input type="number" name="items[0][quantity]" class="form-control mb-1" placeholder="Quantity" required>
                    <input type="number" name="items[0][price]" step="0.01" class="form-control" placeholder="Price" required>
                </div>
            </div>
            <button type="button" class="btn btn-secondary mb-2" onclick="addItem()">Add Item</button>
            <button type="submit" class="btn btn-success">Submit Order</button>
        </form>
    </div>
</div>
<div class="mb-3">

<form method="GET" action="{{ route('orders.index') }}" class="d-flex">

<select name="status" class="form-select w-auto me-2">

<option value="">All Orders</option>

<option value="PENDING">Pending</option>
<option value="PROCESSING">Processing</option>
<option value="SHIPPED">Shipped</option>
<option value="DELIVERED">Delivered</option>
<option value="CANCELED">Canceled</option>

</select>

<button class="btn btn-primary">
Filter
</button>

<a href="{{ route('orders.index') }}" class="btn btn-secondary ms-2">
Reset
</a>

</form>

</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->customer_name }}</td>
            <td>{{ $order->status }}</td>
            <td>
                <a class="btn btn-info btn-sm" href="{{ route('orders.show', $order->id) }}">View</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script>
let count = 1;
function addItem() {
    const div = document.createElement('div');
    div.classList.add('mb-3', 'item-row');
    div.innerHTML = `
        <label>Product</label>
        <input type="text" name="items[${count}][product_name]" class="form-control mb-1" placeholder="Product Name" required>
        <input type="number" name="items[${count}][quantity]" class="form-control mb-1" placeholder="Quantity" required>
        <input type="number" name="items[${count}][price]" step="0.01" class="form-control" placeholder="Price" required>
    `;
    document.getElementById('items').appendChild(div);
    count++;
}
</script>
@endsection
