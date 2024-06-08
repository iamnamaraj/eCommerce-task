@extends('adminlte::page')

    @section('title', 'Update category')
    @section('plugins.Select2', true)
    @section('js')
        <script>
            $(document).ready(function(){
                $('#category_id').Select2({
                    minimunResultsForSearch: 5
                });
            });
        </script>
    @endsection
    @section('content')
    <x-alert/>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold">Update category</h3>
            <div class="card-tools">
                <a href="{{ route('admin.categories.index')}}" class="btn btn-primary btn-sm">Go back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update',$category->id)}}" method="POST">
                @csrf @method('PUT')

                <x-input
                    text="Name"
                    field="name"
                    :current="$category->name"
                />

                {{-- <div class="form-group">
                    <label for="category_id">Parent catagory</label>
                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $category->category_id) selected @endif> {{ $item->name }}</option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <small class="form-text text-danger ">{{ $message }}</small>
                    @enderror
                </div>

                <button class="btn btn-primary btn-sm" type="submit">
                    <i class="fas fa-fw fa-save mr-2"></i>Save
                </button>
            </form> --}}

        @if ($category->category_id !== null)
            <div class="form-group">
                <label for="category_id">Parent category</label>
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="" selected>Select Parent Category</option>
                    @foreach ($categories as $item)
                    <option value="{{ $item->id }}" @if ($item->id == $category->category_id) selected @endif> {{ $item->name }}</option>
                    @endforeach
                </select>

                @error('category_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            @endif


            <button class="btn btn-primary btn-sm" type="submit">
                <i class="fas fa-fw fa-save mr-2"></i>Save
            </button>
        </form>
        </div>
    </div>
@stop