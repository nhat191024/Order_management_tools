<!-- Modal -->
<div class="modal fade" id="branch_detail" tabindex="-1" aria-labelledby="branch_detail" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="branch_detail">Danh sách bàn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="card-container">
                    <!-- Cards will be appended here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Đóng </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showModal(branchId) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            type: "POST",
            url: "{{ route('admin.branch.show_table') }}",
            data: {
                branch_id: branchId,
            },
            success: function(response) {
                const cardContainer = document.getElementById('card-container');
                cardContainer.innerHTML = ''; // Xóa nội dung cũ
                response.data.forEach(function(item) {
                    const colDiv = document.createElement('div');
                    colDiv.className = 'col-md-3';

                    const cardDiv = document.createElement('div');
                    cardDiv.className = 'card mb-2';

                    const cardBodyDiv = document.createElement('div');
                    cardBodyDiv.className = 'card-body';

                    const span = document.createElement('span');
                    span.innerHTML = 'Tên bàn: <strong>' + item + '</strong>';

                    cardBodyDiv.appendChild(span);
                    cardDiv.appendChild(cardBodyDiv);
                    colDiv.appendChild(cardDiv);
                    cardContainer.appendChild(colDiv);
                });
            },
            error: function(response, status, error) {
                var errorMessage = JSON.parse(response.responseText);
                console.log(errorMessage);
            }
        })
        $('#branch_detail').modal('toggle');
    }
</script>
