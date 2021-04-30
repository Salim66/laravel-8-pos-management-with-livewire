<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Add Product</h3><a class="float-right btn btn-dark" data-toggle="modal"
                            href="#dataAddModal"><i class="fa fa-plus"></i> Add New Product</a>
                    </div>
                    {{-- <form action="{{ route('orders.store') }}" method="POST">
                    @csrf --}}
                    <div class="card-body">
                        <form wire:submit.prevent="insertToCart">
                            <input type="text" class="form-control" wire:model="product_code" id=""
                                placeholder="Enter product number">
                        </form>

                        @if(Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if(Session::has('info'))
                        <div class="alert alert-info">{{ Session::get('info') }}</div>
                        @endif
                        @if(Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        }
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Dis (%)</th>
                                    <th colspan="2">Total</th>
                                </tr>
                            </thead>
                            <tbody class="addMoreProduct">
                                @foreach($productInCart as $product)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td width="30%">
                                        <input type="text" class="form-control"
                                            value="{{ $product->product->product_name }}">
                                    </td>
                                    <td width="13%">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <button wire:click.prevent="increment({{ $product->id }})"
                                                    class="btn btn-sm btn-info">+</button>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">{{ $product->product_qty }}</label>
                                            </div>
                                            <div class="col-md-1">
                                                <button wire:click.prevent="decrement({{ $product->id }})"
                                                    class="btn btn-sm btn-danger">-</button>
                                            </div>
                                        </div>

                                        {{-- <input type="number" wire:model="product_qty" name="quantity[]" id="quantity"
                                            class="form-control quantity" value="{{ $product->product_qty }}"> --}}
                                    </td>
                                    <td>
                                        <input type="number" name="price[]" id="price" class="form-control price"
                                            value="{{ $product->product_price }}">
                                    </td>
                                    <td>
                                        <input type="number" name="discount[]" id="discount"
                                            class="form-control discount">
                                    </td>
                                    <td>
                                        <input type="number" name="total_amount[]" id="total_amount"
                                            class="form-control total_amount"
                                            value="{{ $product->product_qty * $product->product_price }}">
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-danger rounded-circle"
                                            wire:click="removeProductCart({{ $product->id }})"><i
                                                class="fa fa-times-circle"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf


                    @foreach($productInCart as $product)
                    <input type="hidden" name="product_id[]" class="form-control" value="{{ $product->product->id }}">
                    <input type="hidden" name="quantity[]" class="form-control" value="{{ $product->product_qty }}">

                    <input type="hidden" name="price[]" id="price" class="form-control price"
                        value="{{ $product->product_price }}">
                    <input type="hidden" name="discount[]" id="discount" class="form-control discount">
                    <input type="hidden" name="total_amount[]" id="total_amount" class="form-control total_amount"
                        value="{{ $product->product_qty * $product->product_price }}">
                    @endforeach

                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Total <b class="tatal">
                                    {{ $productInCart->sum('product_price') }}</b>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="btn-group">
                                <button onClick="PrintReceiptContent('print')" type="button" class="btn btn-dark"><i
                                        class="fa fa-print"></i> Print</button>
                                <button onClick="PrintReceiptContent('print')" type="button" class="btn btn-primary"><i
                                        class="fa fa-print"></i> History</button>
                                <button onClick="PrintReceiptContent('print')" type="button" class="btn btn-danger"><i
                                        class="fa fa-print"></i> Report</button>
                            </div>
                            <div class="panel">
                                <div class="row">
                                    <div class="form-group col-md-6 my-5">
                                        <label for="">Customer Name</label>
                                        <input type="text" name="customer_name" id="customer_name"
                                            class="form-control customer_name">
                                    </div>
                                    <div class="form-group col-md-6 my-5">
                                        <label for="">Customer Phone</label>
                                        <input type="text" name="customer_phone" id="customer_phone"
                                            class="form-control customer_phone">
                                    </div><br>

                                    <div class="form-group ml-3 radio-item">
                                        <label for="">Payment Method</label><br>

                                        <input style="cursor: pointer;" type="radio" name="payment_method"
                                            id="payment_method" class="true" value="cash">
                                        <label style=" cursor: pointer" for="payment_method" class="mr-4"><i
                                                class="fas fa-money-bill text-success"></i> Hand
                                            Cash</label>

                                        <input style="cursor: pointer" type="radio" name="payment_method"
                                            id="payment_method1" class="true" value="band transfer">
                                        <label style="cursor: pointer" for="payment_method1" class="mr-4"><i
                                                class="fas fa-university text-danger"></i> Bank
                                            Transfer</label>

                                        <input style="cursor: pointer" type="radio" name="payment_method"
                                            id="payment_method2" class="true" value="credit cart">
                                        <label style="cursor: pointer" for="payment_method2"><i
                                                class="fas fa-credit-card text-info"></i> Credit
                                            Cart</label>
                                    </div><br>

                                    <div class="form-group col-md-12">
                                        <label for="">Payment Amount</label>
                                        <input type="number" wire:model="pay_money" name="paid_amount" id="paid_amount"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Returning Change</label>
                                        <input type="number" wire:model="balance" name="balance" id="balance"
                                            class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-12 mt-3">
                                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Save">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="button" class="btn btn-lg btn-danger btn-block" value="Calculator">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
