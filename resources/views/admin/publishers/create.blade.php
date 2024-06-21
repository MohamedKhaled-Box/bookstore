@extends('theme.default')
@section('head')
@endsection
@section('heading')
    add a publisher
@endsection
@section('content')
    <div class="row jutify-content-center">
        <div class="card mb-4 col-md-8">
            <div class="card-header text">
                add publisher
            </div>
            <div class="card-body">
                <form action="{{ route('publishers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">book publisher</label>
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
                        <label for="address" class="col-md-4 col-form-label text-md-right">book address</label>
                        <div class="dol-md-6">
                            <textarea id="address" class="@error('address') is-invalid @enderror form-control" name="address"
                                value="{{ old('address') }}" autocomplete="address"cols="30" rows="10"></textarea>
                            @error('address')
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
