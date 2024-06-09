@extends('adminlte::page')

@section('title', 'Create new product')
@section('plugins.Select2', true)
@section('js')
    <script>
        $(document).ready(function(){
            $('#product').select2({
                minimumResultsForSearch: 5
            });

            let attributeIndex = 1;

            $('.add-attribute-group').click(function () {
                let attributeGroup = `
                    <div class="attribute-group">
                        <div class="form-group">
                            <label for="size_id">Choose a size:</label>
                            <select name="attributes[${attributeIndex}][size_id]" class="form-control" required>
                                <option value="" selected>Select Size</option>
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="color_id">Choose a color:</label>
                            <select name="attributes[${attributeIndex}][color_id]" class="form-control" required>
                                <option value="" selected>Select Color</option>
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="attributes[${attributeIndex}][quantity]" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="images">Upload Images:</label>
                            <input type="file" name="attributes[${attributeIndex}][images][]" class="form-control" multiple required>
                        </div>

                        <button type="button" class="btn btn-danger btn-sm remove-attribute-group">Remove</button>
                    </div>
                `;

                $('#attributes-wrapper').append(attributeGroup);
                attributeIndex++;
            });

            $(document).on('click', '.remove-attribute-group', function () {
                $(this).closest('.attribute-group').remove();
            });
        });
    </script>
@endsection

@section('content')
<x-alert/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold">Create new product</h3>
        <div class="card-tools">
            <a href="{{ route('admin.products.index')}}" class="btn btn-primary btn-sm">Go back</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="" selected>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div id="attributes-wrapper">
                <div class="attribute-group">
                    <div class="form-group">
                        <label for="size_id">Choose a size:</label>
                        <select name="attributes[0][size_id]" class="form-control" required>
                            <option value="" selected>Select Size</option>
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="color_id">Choose a color:</label>
                        <select name="attributes[0][color_id]" class="form-control" required>
                            <option value="" selected>Select Color</option>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="attributes[0][quantity]" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="images">Upload Images:</label>
                        <input type="file" name="attributes[0][images][]" class="form-control" multiple required>
                    </div>

                    <button type="button" class="btn btn-danger btn-sm remove-attribute-group">Remove</button>
                </div>
            </div>

            <button type="button" class="btn btn-success btn-sm add-attribute-group">Add Attribute</button>

            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-fw fa-save mr-2"></i>Save
            </button>
        </form>
    </div>
</div>
@endsection
