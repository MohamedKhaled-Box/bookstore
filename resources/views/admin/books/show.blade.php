@extends('theme.default')
@section('head')
    <!-- Custom styles for this page -->
    <link href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        table {
            table-layout: fixed;
        }

        table tr th {
            widows: 30%;
        }
    </style>
@endsection
@section('heading')
    Book Details
@endsection
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
                                    <img class="img-fluid img-thumbnail" src="{{ asset('storage/' . $book->cover_image) }}"
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
                        <a class="btn btn-info btn-sm" href="{{ route('books.edit', $book) }}"><i class="fa fa-edit"></i>
                            تعديل</a>
                        <form method="POST" action="{{ route('books.destroy', $book) }}" class="d-inline-block">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('are you sure ?')"><i class="fa fa-trash"></i>
                                delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
