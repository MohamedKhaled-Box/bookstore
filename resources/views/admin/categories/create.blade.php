@extends('theme.default')
@section('head')
@endsection
@section('heading')
    add a category
@endsection
@section('content')
    <div class="row jutify-content-center">
        <div class="card mb-4 col-md-8">
            <div class="card-header text">
                add category
            </div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">book category</label>
                        <div class="dol-md-6">
                            <input id="name" type="text" class="@error('name') is-invalid @enderror form-control"
                                name="name" value="{{ old('name') }}" autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">book description</label>
                        <div class="dol-md-6">
                            <textarea id="description" class="@error('description') is-invalid @enderror form-control" name="description"
                                value="{{ old('description') }}" autocomplete="description"cols="30" rows="10"></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
