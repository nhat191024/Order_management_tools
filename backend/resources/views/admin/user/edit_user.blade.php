@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sửa tài khoản</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.user.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="branchSelect">Chọn chi nhánh</label>
                            <select required name="branch_id" class="form-control" id="branchSelect">
                                @foreach ($allBranch as $key => $item)
                                    <option {{ $item['id'] == $userInfo['branch_id'] ? 'selected' : '' }} value="{{ $item['id'] }}">
                                        {{ $item['name'] }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tên tài khoản</label>
                            <input required type="text" class="form-control" id="" aria-describedby=""
                                name="username" placeholder="Nhập tên tài khoản" disabled value="{{$userInfo['username']}}">
                        </div>  
                        <div class="form-group">
                            <label for="roleSelect">Chọn quyền</label>
                            <select required name="role_id" class="form-control" id="roleSelect">
                                @foreach ($allRole as $key => $item)
                                    <option {{ $item['id'] == $userInfo['role'] ? 'selected' : '' }}
                                        value="{{ $item['id'] }}"> {{ $item['name'] }} </option>
                                @endforeach
                            </select>
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
