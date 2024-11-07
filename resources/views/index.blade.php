@extends('layouts.app')

@section('content')
    <h1>Products</h1>

    <form method="GET" action="{{ route('products.index') }}">
        <div class="form-row mb-3">
            <div class="col">
                <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
            </div>
            <div class="col">
                <select name="sort_by" class="form-control">
                    <option value="">Sort By</option>
                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Price</option>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Create New Product</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered container-fluid">
        <thead>
            <tr class="text-center">
                <th>Product_ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="text-center">
                    <td>{{ $product->product_id }}</td>
                    <td class="text-left">{{ $product->name }}</td>
                    <td class="text-left">{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
@endsection
