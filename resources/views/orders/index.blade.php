@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @livewire('order')

    <div class="modal">
        <div id="print">
            @include('reports.receipts')
        </div>
    </div>

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

    <script>
        //receipt print
    function PrintReceiptContent(el){
        var data = '<input type="button" id="printPageButton" class="printPageButton" style="display: block; width: 100%; border: none; background-color: #008B8B; color: #fff; padding: 14px 28px; font-size: 16px; cursor: pointer; text-align: center" value="Print Receipt" onclick="window.print()">';
        data += document.getElementById(el).innerHTML;
        myReceipt = window.open("", "myWin", "left=500, top=130, width=400, height=400");
        myReceipt.screnX = 0;
        myReceipt.screnY = 0;
        myReceipt.document.write(data);
        myReceipt.document.title = "Print Receipt";
        myReceipt.focus();
        setTimeout(() => {
            myReceipt.close();
        }, 8000);
    }
    </script>

    @section('script')
    <script>
        // $('document').on('click', '#addMore' function(){

    // });
    $(document).ready(function () {

        // add more product
        $(document).on('click', '#addMore', function(){
            var product = $('.product_id').html();
            var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
            var tr = '<tr><td class="no">'+numberofrow+'</td>'+
                        '<td><select class="form-control product_id" name="product_id[]" id="product_id">'+product+'</select></td>'+
                        '<td><input type="number" name="quantity[]" id="quantity" class="form-control quantity"></td>'+
                        '<td><input type="number" name="price[]" id="price" class="form-control price"></td>'+
                        '<td><input type="number" name="discount[]" id="discount" class="form-control discount"></td>'+
                        '<td><input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount"></td>'+
                        '<td><a class="btn btn-sm btn-danger rounded-circle delete" href=""><i class="fa fa-times-circle"></i></a></td>'+
                    '</tr>';
                    $('.addMoreProduct').append(tr);
                    return false;
        });

        //product delete
        $(document).on('click', '.delete', function(event){
            event.preventDefault();
            $(this).parent().parent().remove();
        });

        function totalAmount(){
            var total = 0;
            $('.total_amount').each(function(i, e){
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.tatal').html(total);
        }

        $(document).on('change', '#product_id', function(){
            var tr = $(this).parent().parent();
            var price = tr.find('.product_id option:selected').attr('data-price');
            tr.find('.price').val(price);
            var quantity = tr.find('.quantity').val() - 0;
            var price = tr.find('.price').val() - 0;
            var discount = tr.find('.discount').val() - 0;
            var total_amount = (quantity * price) - ((quantity*price*discount)/100);
            tr.find('.total_amount').val(total_amount);
            totalAmount();
        });

        $(document).on('keyup click', '.quantity,.discount', function(){
            var tr = $(this).parent().parent();
            var quantity = tr.find('.quantity').val() - 0;
            var price = tr.find('.price').val() - 0;
            var discount = tr.find('.discount').val() - 0;
            var total_amount = (quantity * price) - ((quantity*price*discount)/100);
            tr.find('.total_amount').val(total_amount);
            totalAmount();
        });

        $(document).on('keyup', '#paid_amount', function(){
            var total = $('.tatal').html();
            var paid_amount = $(this).val();
            var tot = paid_amount - total;
            $('#balance').val(tot).toFixed;
        });



    });
    </script>
    @endsection
