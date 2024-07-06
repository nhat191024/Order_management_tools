@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sửa bếp</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.kitchen.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="categorySelect">Chọn chi nhánh</label>
                            <select name="branch_id" class="form-control" id="categorySelect">
                                @foreach($allBranch as $key => $item)
                                    <option {{ $item['id'] == $kitchenInfo['branch_id'] ? 'selected' : '' }} value="{{ $item['id'] }}"> {{ $item['name'] }} </option>
                                
                                @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                            <label for="">Tên bếp</label>
                            <input required type="text" class="form-control" id="" aria-describedby=""
                                name="kitchen_name" placeholder="Nhập tên bếp" value="{{ $kitchenInfo['name'] }}">
                        </div>
                        <label for="">Ảnh bếp</label>
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" id="customFile"
                                name="kitchen_image">
                            <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                        </div>
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button class="btn btn-success mt-4" type="submit">Sửa</button>
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
