@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Quản lý món ăn</h1>
            <!-- DataTales Example -->
            <div class="card mb-4 shadow">
                <div class="card-header py-3">
                    <a class="btn btn-primary" href="{{ route('admin.dish.show_add') }}">Thêm món ăn</a>

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
                        <table id="dataTable" class="table-bordered table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên thực phẩm</th>
                                    <th>Phương thức nấu</th>
                                    <th>Giá thêm</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên thực phẩm</th>
                                    <th>Phương thức nấu</th>
                                    <th>Giá thêm</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            // Destroy default DataTable if exists
            if ($.fn.DataTable.isDataTable('#dataTable')) {
                $('#dataTable').DataTable().destroy();
            }

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.dish.datatable') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'food_name',
                        name: 'food_name'
                    },
                    {
                        data: 'cooking_method_name',
                        name: 'cooking_method_name'
                    },
                    {
                        data: 'additional_price',
                        name: 'additional_price'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    processing: "Đang xử lý...",
                    lengthMenu: "Hiển thị _MENU_ món ăn",
                    zeroRecords: "Không tìm thấy món ăn nào",
                    info: "Hiển thị _START_ đến _END_ trong tổng số _TOTAL_ món ăn",
                    infoEmpty: "Hiển thị 0 đến 0 trong tổng số 0 món ăn",
                    infoFiltered: "(lọc từ _MAX_ món ăn)",
                    search: "Tìm kiếm:",
                    paginate: {
                        first: "Đầu",
                        last: "Cuối",
                        next: "Sau",
                        previous: "Trước"
                    }
                }
            });
        });
    </script>
@endpush
