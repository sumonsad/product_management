@extends('layouts.app')

@section('content')
    <h1>Create Product</h1>
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="product_id">Product ID</label>
            <input type="text" name="product_id" class="form-control" required>
            @error('product_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" class="form-control">
            @error('stock')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
