@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">



        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-flex justify-content-between">
                <h1 class="h3 mb-2 text-gray-800">Chi tiết hóa đơn số {{$billInfo->id}}</h1>
                <a href="{{route('admin.bill.index')}}" class="btn btn-primary mb-1">Back</a>
            </div>
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
                        <form action="">
                            <div class="form-group">
                                <label for="">Tên cơ sở</label>
                                <input type="text" class="form-control" id="" aria-describedby=""
                                    name="" disabled placeholder="" value="{{$billInfo->table->branch->name}}">
                            </div>
                            <div class="form-group">
                                <label for="">Tên bàn</label>
                                <input type="text" class="form-control" id="" aria-describedby=""
                                    name="" disabled placeholder="" value="{{$billInfo->table->table_number}}">
                            </div>
                            <div class="form-group">
                                <label for="">Tên nhân viên thanh toán</label>
                                <input type="text" class="form-control" id="" aria-describedby=""
                                    name="" disabled placeholder="" value="{{$billInfo->user->username ?? "Khách" }}">
                            </div>
                            <div class="form-group">
                                <label for="">Thời gian vào</label>
                                <input type="text" class="form-control" id="" aria-describedby=""
                                    name="" disabled placeholder="" value="{{$billInfo->time_in}}">
                            </div>
                            <div class="form-group">
                                <label for="">Thời gian ra</label>
                                <input type="text" class="form-control" id="" aria-describedby=""
                                    name="" disabled placeholder="" value="{{$billInfo->time_out}}">
                            </div>
                            <div class="form-group">
                                <label for="">Phương thức thanh toán</label>
                                <input type="text" class="form-control" id="" aria-describedby=""
                                    name="" disabled placeholder="" value="{{$billInfo->pay_status == 0 ? 'Tiền mặt' : 'Chuyển khoản'}}">
                            </div>
                            <div class="form-group">
                                <label for="">Tổng tiền</label>
                                <input type="number" class="form-control" id="" aria-describedby=""
                                    name="" disabled placeholder="" value="{{$billInfo->total}}">
                            </div>
                        </form>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên món ăn</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Tổng giá</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên món ăn</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Tổng giá</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($billInfo->billDetail as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->dish->food->name . ' ' .  $item->dish->CookingMethod->name}}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->price }}</td>
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
