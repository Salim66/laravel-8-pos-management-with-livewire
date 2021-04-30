<table class="table table-bordered">
    <thead>
        <tr>
            <th>#SL</th>
            <th>Product Name</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Alert Stock</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($all_data as $data)
        <tr>
            <td>{{ $loop->index+1 }}</td>
            <td style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="Click and view detials"
                wire:click="getProductDetails({{ $data->id }})">{{ $data->product_name }}</td>
            <td>{{ $data->brand }}</td>
            <td>{{ $data->price }}</td>
            <td>{{ $data->quantity }}</td>
            <td>
                @if($data->alert_stock > $data->quantity)
                <span class="badge badge-danger">Low Stock > {{ $data->alert_stock }}</span>
                @else
                <span class="badge badge-success">{{ $data->alert_stock }}</span>
                @endif
            </td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-info btn-sm" data-toggle="modal" href="#dataEditModal{{ $data->id }}"><i
                            class="fa fa-edit"></i>
                        Edit</a>
                    <a class="btn btn-danger btn-sm" data-toggle="modal" href="#dataDeleteModal{{ $data->id }}"><i
                            class="fa fa-trash"></i>
                        Delete</a>
                </div>
            </td>
        </tr>

        {{-- edit data modal --}}
        @include('products.edit')

        {{-- delete data modal --}}
        @include('products.delete')
        @endforeach
    </tbody>
</table>
