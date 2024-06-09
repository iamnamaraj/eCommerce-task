@extends('adminlte::page')

@section('title', 'Product List')

@section('content')
<x-alert />
<x-delete />

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Product List</h3>
        <div class="card-tools">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">Add New Product</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Attributes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            @foreach ($product->attributeProducts as $attributeProduct)
                                <div>
                                    <strong>Size:</strong> {{ $attributeProduct->size->name }}<br>
                                    <strong>Color:</strong> {{ $attributeProduct->color->name }}<br>
                                    <strong>Quantity:</strong> {{ $attributeProduct->quantity }}<br>
                                    <strong>Images:</strong>
                                    @foreach ($attributeProduct->images as $image)
                                        <img src="{{ Storage::url($image->image) }}" alt="Product Image" width="50" height="50">
                                    @endforeach
                                </div>
                                <hr>
                            @endforeach
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $product->id }})">
                                Delete
                            </button>

                            <form id="delete-form-{{ $product->id }}" style="display:none" action="{{ route('admin.products.destroy',$product->id) }}" method="POST">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No products found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-2">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
