<div id="dataEditModal{{ $data->id }}" class="modal fade right">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="float-left">Edit Product</h3><button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="product_name" class="form-control" value="{{ $data->product_name }}">
                    </div>
                    <div class="form-group">
                        <label for="">Product Code</label>
                        <input type="text" name="product_code" class="form-control" value="{{ $data->product_code }}">
                    </div>
                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" name="brand" class="form-control" value="{{ $data->brand }}">
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="price" class="form-control" value="{{ $data->price }}">
                    </div>
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $data->quantity }}">
                    </div>
                    <div class="form-group">
                        <label for="">Alert Stock</label>
                        <input type="number" name="alert_stock" class="form-control" value="{{ $data->alert_stock }}">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" rows="2">{{ $data->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <img width="100px" height="100px" src="{{ asset('products/images/'.$data->product_image) }}"
                            alt="">
                        <input type="file" name="product_image" class="form-control-file"
                            value="{{ $data->product_image }}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Update
                            Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
