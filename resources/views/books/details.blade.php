@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">book details</div>
                    <div class="card-body">
                        <table class="table table-stribed">
                            <tr>
                                <th>title: </th>
                                <td class="lead"><b>{{ $book->title }}</b></td>
                            </tr>
                            @if ($book->isbn)
                                <tr>
                                    <th>
                                        isbn
                                    </th>
                                    <td>{{ $book->isbn }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th>cover image</th>
                                <td>
                                    <img class="img-fluid img-thumbnail" src="{{ asset('' . $book->cover_image) }}"
                                        alt="Cover image">
                                </td>
                            </tr>
                            @if ($book->category)
                                <tr>
                                    <th>category</th>
                                    <td>{{ $book->category->name }}</td>
                                </tr>
                            @endif
                            @if ($book->authors()->count() > 0)
                                <tr>
                                    <th>authors</th>
                                    <td>
                                        @foreach ($book->authors as $author)
                                            {{ $loop->first ? '' : 'and' }}
                                            {{ $author->name }}
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                            @if ($book->publisher)
                                <tr>
                                    <th>publisher</th>
                                    <td>{{ $book->publisher->name }}</td>
                                </tr>
                            @endif
                            @if ($book->description)
                                <tr>
                                    <th>
                                        Description
                                    </th>
                                    <td>{{ $book->description }}</td>
                                </tr>
                            @endif
                            @if ($book->publisher_year)
                                <tr>
                                    <th>
                                        Publish year
                                    </th>
                                    <td>{{ $book->publisher_year }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th>
                                    number of pages
                                </th>
                                <td>{{ $book->number_of_pages }}</td>
                            </tr>
                            <tr>
                                <th>
                                    number of copies
                                </th>
                                <td>{{ $book->number_of_copies }}</td>
                            </tr>
                            <tr>
                                <th>
                                    price
                                </th>
                                <td>{{ $book->price }} $</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
