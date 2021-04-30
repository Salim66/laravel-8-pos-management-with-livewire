<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Add Product</h3><a class="float-right btn btn-dark"
                                data-toggle="modal" href="#dataAddModal"><i class="fa fa-plus"></i> Add New Product</a>
                        </div>
                        <div class="card-body">
                            @include('products.table')
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Search Product</h3>
                        </div>
                        <div class="card-body">
                            @include('products.details')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- add data modal --}}
@include('products.add')
