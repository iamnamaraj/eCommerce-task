@extends('adminlte::page')

    @section('title', 'Category details')

    @section('content')
    <x-alert/>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold">Category information</h3>
            <div class="card-tools">
                <a href="{{ route('admin.categories.index')}}" class="btn btn-primary btn-sm">Go back</a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped ">
                <tr>
                    <th width = 15%>Id</th>
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $category->name }}</td>
                </tr>

                @if ($category->category_id)
                    <tr>
                        <th>Parent category</th>
                        <td>
                            <a href="{{ route('admin.categories.show', $category->category_id) }}">
                                {{ $category->category->name }}
                            </a>
                        </td>
                    </tr>
                @endif

                <tr>
                    <th>Sub categories</th>
                    <td>
                        @if ($category->categories->isNotEmpty())
                            <ul>
                                @foreach ($category->categories as $item)
                                    <li>
                                        <a href="{{ route('admin.categories.show', $item->id) }}">
                                            {{ $item->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No subcategories available</p>
                        @endif
                    </td>
                </tr>

            </table>
        </div>
    </div>
@stop