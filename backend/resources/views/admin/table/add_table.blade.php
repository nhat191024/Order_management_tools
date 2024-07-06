@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Thêm bàn</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.table.add') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="branchSelect">Chọn bàn</label>
                            <select name="branch_id" class="form-control" id="branchSelect">
                                @foreach ($allBranch as $key => $item)
                                    <option {{ $key == 0 ? 'selected' : '' }} value="{{ $item['id'] }}">
                                        {{ $item['name'] }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tên bàn</label>
                            <input required type="text" class="form-control" id="" aria-describedby=""
                                name="table_name" placeholder="Nhập tên bàn">
                        </div>
                        <button class="btn btn-success mt-4" type="submit">Thêm</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->



    <!-- End of Content Wrapper -->
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
