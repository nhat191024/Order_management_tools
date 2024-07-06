@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">



        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Quản lý chi nhánh</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a class="btn btn-primary" href="{{ route('admin.branch.show_add') }}">Thêm chi nhánh</a>

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
                                    <th>Tên chi nhánh</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên chi nhánh</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allBranch as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td class="text-center"><a class="btn btn-warning"
                                                href="{{ route('admin.branch.show_edit', ['id' => $item->id]) }}">Sửa</a> <a
                                                class="btn btn-danger"
                                                href="{{ route('admin.branch.delete', ['id' => $item->id]) }}"
                                                onclick="confirm('Bạn chắc chắn chứ?')"> Xóa </a>
                                            <button class="btn btn-primary" onclick="showModal({{$item['id']}})"
                                                href="{{ route('admin.branch.show_table', ['id' => $item->id]) }}">Chi tiết
                                                bàn</button>
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
    @include('admin.modal.branch_detail_modal')
    <!-- End of Content Wrapper -->
@endsection
