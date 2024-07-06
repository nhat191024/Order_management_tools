@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">



        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Quản lý hóa đơn</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
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
                                    <th>Tên cơ sở</th>
                                    <th>Tên bàn</th>
                                    <th>Tên nhân viên</th>
                                    <th>Giờ vào</th>
                                    <th>Giờ ra</th>
                                    <th>Tình trạng</th>
                                    <th>Tổng tiền</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên cơ sở</th>
                                    <th>Tên bàn</th>
                                    <th>Tên nhân viên</th>
                                    <th>Giờ vào</th>
                                    <th>Giờ ra</th>
                                    <th>Tình trạng</th>
                                    <th>Tổng tiền</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allBill as $key => $item)
                                    <tr>
                                        <td>{{ $item->id}}</td>
                                        <td>{{ $item->table->branch->name }}</td>
                                        <td>{{ $item->table->table_number }}</td>
                                        <td>{{ $item->user->username ?? "Khách"}}</td>
                                        <td>{{ $item->time_in }}</td>
                                        <td>{{ $item->time_out }}</td>
                                        <td>{{ $item->pay_status == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td class="text-center"><a class="btn btn-warning"
                                                href="{{ route('admin.bill.show_detail', ['id' => $item->id]) }}">Chi tiết</a>
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
