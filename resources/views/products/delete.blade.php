<div id="dataDeleteModal{{ $data->id }}" class="modal fade right">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="float-left">Delete Product</h3><button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <p class="text-center">Are you sure you want to delete this
                        {{ $data->product_name }} ?</p>

                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
