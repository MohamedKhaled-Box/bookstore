@extends('theme.default')
@section('head')
@endsection
@section('heading')
    add a new book
@endsection
@section('content')
    <div class="row jutify-content-center">
        <div class="card mb-4 col-md-8">
            <div class="card-header text">
                add a new book
            </div>
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">book title</label>
                        <div class="dol-md-6">
                            <input id="title" type="text" class="@error('title') is-invalid @enderror form-control"
                                name="title" value="{{ old('title') }}" autocomplete="title">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="isbn" class="col-md-4 col-form-label text-md-right">book isbn</label>
                        <div class="dol-md-6">
                            <input id="isbn" type="number" class="@error('isbn') is-invalid @enderror form-control"
                                name="isbn" value="{{ old('isbn') }}" autocomplete="isbn">
                            @error('isbn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cover_image" class="col-md-4 col-form-label text-md-right">book cover</label>
                        <div class="dol-md-6">
                            <input accept="image/*"id="cover_image" type="file" onchange="readCoverImage(this)"
                                class="@error('cover_image') is-invalid @enderror form-control" name="cover_image"
                                value="{{ old('cover_image') }}" autocomplete="cover_image">
                            @error('cover_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <img id="cover-image-thumb" class="img-fluid img-thumbnail" src="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="col-md-4 col-form-label text-md-right">book category</label>
                        <div class="dol-md-6">
                            <select name="category" id="category" class="form-control">
                                <option disabled selected>choose a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="authors" class="col-md-4 col-form-label text-md-right">book authors</label>
                        <div class="dol-md-6">
                            <select name="authors[]" multiple id="authors" class="form-control">
                                <option disabled selected>choose an author</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                            @error('authors')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="publisher" class="col-md-4 col-form-label text-md-right">book publisher</label>
                        <div class="dol-md-6">
                            <select name="publisher" id="publisher" class="form-control">
                                <option disabled selected>choose a publisher</option>
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                            @error('publisher')
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
                    <div class="form-group row">
                        <label for="publish_year" class="col-md-4 col-form-label text-md-right">publish year</label>
                        <div class="dol-md-6">
                            <input id="publish_year" type="number"
                                class="@error('publish_year') is-invalid @enderror form-control" name="publish_year"
                                value="{{ old('publish_year') }}" autocomplete="title">
                            @error('publish_year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="number_of_pages" class="col-md-4 col-form-label text-md-right">number of pages</label>
                        <div class="dol-md-6">
                            <input id="number_of_pages" type="number"
                                class="@error('number_of_pages') is-invalid @enderror form-control" name="number_of_pages"
                                value="{{ old('number_of_pages') }}" autocomplete="number_of_pages">
                            @error('number_of_pages')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="number_of_copies" class="col-md-4 col-form-label text-md-right">number of
                            copies</label>
                        <div class="dol-md-6">
                            <input id="number_of_copies" type="number"
                                class="@error('number_of_copies') is-invalid @enderror form-control"
                                name="number_of_copies" value="{{ old('number_of_copies') }}"
                                autocomplete="number_of_copies">
                            @error('number_of_copies')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-right">price</label>
                        <div class="dol-md-6">
                            <input id="price" type="number"
                                class="@error('price') is-invalid @enderror form-control" name="price"
                                value="{{ old('price') }}" autocomplete="price">
                            @error('price')
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
@section('script')
    <script>
        function readCoverImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#cover-image-thumb').attr('src', e.target.result);

                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
