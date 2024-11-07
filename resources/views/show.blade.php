@extends('layouts.app')

@section('content')
<h1>Product Name: {{ $product->name }}</h1>
<table class="table table-bordered">
    <thead>
        <tr class="text-center">
            <th>Product ID</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Image</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr class="text-center">
            <td>{{ $product->product_id }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                @if ($product->image)
                {{-- <img style="width:50px;height:50px;"src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid"> --}}
                <img style="width:50px;height:50px;"src="{{ url($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                @else
                No image available.
                @endif
            </td>
        <td><a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a></td>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <td><button type="submit" class="btn btn-danger">Delete</button></td>
        </form>
        </tr>
    </tbody>
</table>
@endsection
