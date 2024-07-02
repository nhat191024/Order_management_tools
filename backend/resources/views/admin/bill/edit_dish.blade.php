@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sửa món ăn</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.dish.edit') }}" method="post"">
                        @csrf
                        <div class="form-group">
                            <label for="foodSelect">Chọn thực phẩm</label>
                            <select required name="food_id" class="form-control selectpicker" data-live-search="true"
                                id="foodSelect">
                                @foreach ($allFood as $key => $item)
                                    <option {{ $item['id'] == $dishInfo['food_id'] ? 'seleted' : '' }} value="{{ $item['id'] }}">
                                        {{ $item['name'] }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="methodSelect">Chọn chọn phương thức nấu</label>
                            <select required name="method_id" class="form-control selectpicker" data-live-search="true"
                                id="methodSelect">
                                @foreach ($allMethod as $key => $item)
                                    <option {{ $item['id'] == $dishInfo['cooking_method_id'] ? 'seleted' : '' }} value="{{ $item['id'] }}">
                                        {{ $item['name'] }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Giá thêm</label>
                            <input required type="number" class="form-control" id="" aria-describedby=""
                                name="additional_price" placeholder="" value="{{$dishInfo['additional_price'] ?? 0}}">
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
