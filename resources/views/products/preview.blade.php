<div id="productPreviewModal{{ $product->id }}" class="modal fade right">
    <div class="modal-dialog" style="width: 300px">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="float-left">{{ $product->product_name }}</h3>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <img src="{{ URL::to('/') }}/products/images/{{ $product->product_image }}" width="250px" height="200px"
                    alt="" style="display: block; margin: auto; margin-botton: 5px;">
                <img src="{{ URL::to('/') }}/products/barcodes/{{ $product->barcode }}" alt=""
                    style="width: 180px; margin: auto; display: block; margin-top: 20px;">
                <h5 style="text-align: center;">{{ $product->product_code }}</h5>
            </div>
        </div>
    </div>
</div>
