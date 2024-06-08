@extends('adminlte::page')

@section('title', 'All categories')

@section('content')
<x-alert />
<x-delete />

<div class="card">

    <div class="card-header">
        <h3 class="card-title text-bold">All categories</h3>

        <div class="card-tools">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
                Add new category
            </a>
        </div>

    </div>

    <div class="card-body p-0">
        <table class="table table-bordered table-striped">

            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>parent</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if ($category->category_id)
                        <a href="{{ route('admin.categories.show', $category->category_id) }}">
                            {{ $category->category->name }}
                        </a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-secondary btn-sm">
                            Details
                        </a>

                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm">
                            Edit
                        </a>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $category->id }})">
                            Delete
                        </button>


                        <form id="delete-form-{{ $category->id }}" style="display:none" action="{{ route('admin.categories.destroy',$category->id) }}" method="POST">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($categories->perPage() < $categories->total())
        <div class="card-footer">
            {{  $categories->links() }}
        </div>
    @endif
</div>

@stop