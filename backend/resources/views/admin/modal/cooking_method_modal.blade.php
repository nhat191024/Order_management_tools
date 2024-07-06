<!-- Modal -->
<div class="modal fade" id="cooking_method" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quản lý chức năng bếp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.kitchen.add_kitchen_method')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        @foreach ($allMethod as $item)
                            <div class="col-md-3 ">
                                <div class="card mb-2" >
                                    <div class="card-body">
                                        <input value="{{ $item['id'] }}" type="checkbox"
                                            id="checkbox{{ $item['id'] }}" name="cooking_method_id[]">
                                        <label for="checkbox{{ $item['id'] }}">{{ $item['name'] }}</label>
                                    </div>
                                </div>  
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="kitchen_id" name="kitchen_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showModal(kitchenId) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            type: "POST",
            url: "{{ route('admin.kitchen.get_kitchen_method') }}",
            data: {
                kitchen_id: kitchenId,
            },
            success: function(response) {
                $('#kitchen_id').val(kitchenId);
                response.data.forEach(function(itemId) {
                    $('#checkbox' + itemId).prop('checked', true);
                });
            },
            error: function(response, status, error) {
                var errorMessage = JSON.parse(response.responseText);
                console.log(errorMessage);
            }
        })
        $('#cooking_method').modal('toggle');
    }
</script>
