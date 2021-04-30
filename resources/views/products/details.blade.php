<div class="row">

    @forelse ($product_details as $product)
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Image</label>
            <img style="cursor: pointer" data-toggle="modal" data-target="#productPreviewModal{{ $product->id }}"
                src="{{ URL::to('/') }}/products/images/{{ $product->product_image }}" width="40px" height="30px"
                alt="">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Product Name</label>
            <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" readonly>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Product Code</label>
            <input type="text" name="product_code" class="form-control" value="{{ $product->product_code }}" readonly>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Product QTY</label>
            <input type="text" name="quantity" class="form-control" value="{{ $product->quantity }}" readonly>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Alert Stock</label>
            <input type="text" name="alert_stock" class="form-control" value="{{ $product->alert_stock }}" readonly>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" class="form-control" rows="2" readonly>{{ $product->description }}</textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <img src="{{ URL::to('/') }}/products/barcodes/{{ $product->barcode }}" alt=""
                style="width: 180px; margin: auto; display: block;">
            <h5 style="text-align: center;">{{ $product->product_code }}</h5>
        </div>
    </div>
    @include('products.preview')
    @empty

    @endforelse

</div>
<style type="text/css">
    input:read-only {
        background: #fff !important;
    }

    textarea:read-only {
        background: #fff !important;
    }
</style>
