@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">



        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Danh sách tài khoản</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a class="btn btn-primary" href="{{ route('admin.user.show_add') }}">Thêm tài khoản</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Username</th>
                                    <th>Quyền</th>
                                    <th>Chi nhánh</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Username</th>
                                    <th>Quyền</th>
                                    <th>Chi nhánh</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allUser as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item['role'] == 1 ? 'admin' : ($item['role'] == 2 ? 'Nhân viên' : 'Bếp') }}
                                        </td>
                                        <td>{{ $item->branch->name }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-warning"
                                                href="{{ route('admin.user.show_edit', ['id' => $item->id]) }}">Sửa
                                            </a>
                                            {{-- <a class="btn btn-danger"
                                                href="{{ route('admin.user.delete', ['id' => $item->id]) }}"
                                                onclick="confirm('Bạn chắc chắn chứ?')"> Xóa
                                            </a> --}}
                                            <a class="btn btn-danger"
                                                href="{{ route('admin.user.reset', ['id' => $item->id]) }}"
                                                onclick="confirm('Bạn chắc chắn chứ?')"> Reset (123)
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->
@endsection
