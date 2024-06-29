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
            <div class="modal-body">
                <div class="row">
                    @foreach ($allMethod as $item)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <input checked value="{{$item['id']}}" type="checkbox" id="checkbox{{$item['id']}}">
                                    <label for="checkbox1">{{ $item['name'] }}</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </div>
</div>

<script>
    function getSelectedCheckboxes() {
        const checkboxes = document.querySelectorAll('.card-body input[type="checkbox"]');
        const selected = [];
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selected.push(checkbox.value);
            }
        });
        alert('Selected checkboxes: ' + selected.join(', '));
    }
</script>
