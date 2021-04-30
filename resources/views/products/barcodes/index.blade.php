@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Product Barcodes</h3>
                        </div>
                        <div class="card-body">
                            <div id="print">
                                <div class="row">
                                    @forelse ($all_data as $data)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="overflow: hidden; text-align: center;">
                                                {!! $data->barcode !!}
                                                <h4 class="text-center" style="padding: 1em; margin-top: 2em;">
                                                    {{ $data->product_code }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <p>No Data Found</p>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
