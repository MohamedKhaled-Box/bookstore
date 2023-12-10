@extends('layouts.main')
@section('head')
    {{-- <style>
        .card .card-body .card-title {
            height: 40px;
            overflow: hidden;
        }
    </style> --}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('search') }}" method="GET">
                <div class="row d-flex justify-content-center">
                    <input type="text" class="col-3 mx-sm-3 mb-2" name="term" placeholder="Search for a book...">
                    <button type="submit" class="col-1 btn btn-secondary bg-secondary mb-2">Search</button>
                </div>
            </form>
        </div>
        <hr>
        <h3 class="my-3">{{ $title }}</h3>
        <div class="row">
            @if ($books->count())
                @foreach ($books as $book)
                    @if ($book->number_of_copies > 0)
                        <div class="col-lg-3 col-md-4 col-sm-6 mt-2">
                            <div class="card mb-3">
                                <div class="card-img-actions">
                                    <a href="{{ route('book.details', $book) }}" class="text-default mb-2">
                                        <img src="{{ asset('' . $book->cover_image) }}" class="card-img img-fluid"
                                            width="96" height="350" alt="">
                                    </a>
                                </div>
                                <div class="card-body bg-light text-center">
                                    <div class="mb-2">
                                        <h6 class="font-weight-semibold mb-2">
                                            <a href="{{ route('book.details', $book) }}" class="text-default mb-2"
                                                data-abc="true">{{ $book->title }}</a>
                                        </h6>
                                        <a href="{{ route('gallery.categories.show', $book->category) }}" class="text-muted"
                                            data-abc="true">
                                            @if ($book->category != null)
                                                {{ $book->category->name }}
                                            @endif
                                        </a>
                                    </div>
                                    <h3 class="mb-0 font-weight-semibold">{{ $book->price }} $</h3>
                                    <div>
                                        <i class="fa fa-star star"></i>
                                        <i class="fa fa-star star"></i>
                                        <i class="fa fa-star star"></i>
                                        <i class="fa fa-star star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p>No Results!</p>
                    <hr>
                    <p class="mb-0">Thank you</p>
                </div>
            @endif
        </div>
        {{-- {{ $books->links() }} --}}
    </div>
@endsection
