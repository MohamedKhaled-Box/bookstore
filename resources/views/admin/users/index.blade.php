@extends('theme.default')

@section('head')
    <link href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('heading')
    users
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>email</th>
                        <th>user type</th>
                        <th>options</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->isSuperAdmin() ? 'super admin' : ($user->isAdmin() ? 'is admin' : 'user') }}</td>
                            <td>
                                <form action="{{ route('users.update', $user) }}" class="ml-4 form-inline" method="POST"
                                    style="display:inline-block">
                                    @method('patch')
                                    @csrf
                                    <select name="administration_level" class="form-control form-control-sm">
                                        <option selected disabled>choose a type</option>
                                        <option value="0">user</option>
                                        <option value="1">admin</option>
                                        <option value="2">super admin</option>
                                    </select>
                                    <button type="submit" class="btn btn-info btn-sm" class="fa fa-edit">edit</button>
                                </form>
                                <form action="{{ route('users.destroy', $user) }}" style="display: block" method="POST">
                                    @method('delete')
                                    @csrf()
                                    @if (auth()->user() != $user)
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('are u sure')"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    @else
                                        <div class="btn btn-danger btn-sm disabled"> <i class="fa fa-trash"></i>delete</div>
                                    @endif
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
