@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sửa thực phẩm</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.food.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="categorySelect">Chọn danh mục</label>
                            <select name="category_id" class="form-control" id="categorySelect">
                                @foreach($allCategory as $key => $item)
                                    <option {{ $item['id'] == $foodInfo['category_id'] ? 'selected' : '' }} value="{{ $item['id'] }}"> {{ $item['name'] }} </option>
                                
                                @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                            <label for="">Tên thực phẩm</label>
                            <input required type="text" class="form-control" id="" aria-describedby=""
                                name="food_name" placeholder="Nhập tên thực phẩm" value="{{ $foodInfo['name'] }}">
                        </div>
                        <div class="form-group">
                            <label for="">Giá thực phẩm</label>
                            <input required type="number" class="form-control" id="" aria-describedby=""
                                name="food_price" placeholder="Nhập giá sản phẩm" value="{{ $foodInfo['price'] }}">
                        </div>
                        <label for="">Ảnh thực phẩm</label>
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" id="customFile"
                                name="food_image">
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
