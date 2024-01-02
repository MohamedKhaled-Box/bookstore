@extends('theme.default')

@section('head')
    <link href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('heading')
    catgegories
@endsection

@section('content')
    <a class="btn btn-primary" href="{{ route('books.create') }}"><i class="fas fa-plus"></i> أضف تصنيفا جديدًا</a>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>لاسمم</th>
                        <th>الوصف</th>
                        <th>خيارات</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</a></td>
                            <td>{{ $category->description }}</td>

                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('categories.edit', $category) }}"><i
                                        class="fa fa-edit"></i> تعديل</a>
                                <form method="POST" action="{{ route('categories.destroy', $category) }}"
                                    class="d-inline-block">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('are you sure ?')"><i class="fa fa-trash"></i>
                                        delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#books-table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
                }
            });
        });
    </script>
@endsection
