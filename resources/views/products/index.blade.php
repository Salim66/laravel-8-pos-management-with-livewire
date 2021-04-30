@extends('layouts.app')

@section('content')

@livewire('products')

<style>
    .card-header h3 {
        font-weight: bolder;
        text-transform: uppercase;
        font-size: 1.3rem;
    }

    .modal-header h3 {
        font-weight: bolder;
        text-transform: uppercase;
        font-size: 1.3rem;
    }

    .modal.right .modal-dialog {
        top: 0px;
        right: 0px;
        margin-right: 17vh;
    }

    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }
</style>
@endsection
