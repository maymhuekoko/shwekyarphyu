@extends('master')

@section('title','Supplier Credit Detail')

@section('place')

@endsection
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h4 class="text-themecolor m-b-0 m-t-0">Supplier Credit Detail</h4>

            </div>
            <div class="col-md-7 col-8 float-right">
                <div class="btn-group">
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalall">All Voucher</button>
                </div>
            </div>
            <form action="{{route('store_all_suppliercredit',$supplier->id)}}" method="post">
            @csrf
            <!-- Begin all modal -->
            <div id="myModalall" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                    <h4 class="modal-title float-left">All Credit Repayment</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
                    <div class="md-form">
                    <label>Due Repayment Amount</label>
                        <input type="text" name="repayremark" class="form-control" id="repayremark" value="{{$supplier->credit_amount}}" readonly>
                        <label>Repayment Amount:</label>
                        <input type="text" class="form-control" name="repay" id="repay" onkeyup="calrepay()">

                        <label>Pay Date:</label>
                        <input type="date" name="repaydate" class="form-control" id="repaydate" value="<?= date("Y-m-d"); ?>">

                        <label>Remark:</label>
                        <input type="text" name="remark" class="form-control" id="remark">
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">Pay</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                    </div>

                </div>
                </div>
            <!-- End all modal -->
        </form>
        </div>
        <form action="{{route('store_each_paid_supplier')}}" method="post">
        @csrf
        <div id="clear">
        <div class="alert alert-primary text-center" role="alert">
         အ&nbsp;ကြွေး&nbsp;ရှင်း&nbsp;လင်း&nbsp;ပြီးသော&nbsp; <a href="#" class="alert-link">Voucher</a>.
        </div>`
        </div>  <!-- clear -->
        <div class="container row ml-4 mb-5" id="eacheach">
            <div class="col-md-3 col-xl-3 pt-3 mb-2">

                <label class="focus-label">Purchase ID</label>

                <input type="text" class="form-control" name="vouid" id="vouid" disabled>
                <input type="hidden" class="form-control" name="purchase_id" id="vou_id">

            </div>
            <div class="col-md-3 col-xl-3 pt-3 mb-2">

                <label class="focus-label">Due Amount</label>

                <input type="text" class="form-control" name="dueamt" id="dueamt" readonly>
                <input type="hidden" class="form-control" name="due_amt" id="due_amt">

            </div>
            <div class="col-md-3 col-xl-3 pt-3 mb-2">

                <label class="focus-label">Pay Amount:</label>

                <input type="text" class="form-control" name="payamt" id="payamt" onkeyup="showdue()">

                <input type="hidden" name="total" id="total" value="{{$supplier->credit_amount}}">
                <input type="hidden" name="supid" id="supid" value="">

            </div>
            <div class="col-md-2 col-xl-3 pt-3">
            <label class="focus-label">Pay Date:</label>
            <br>
                 <input type="date" name="paydate" class="form-control col-md-8" id="paydate">

                 <button type="button" class="btn btn-outline-danger ml-3" data-toggle="modal" data-target="#myModal">Pay</button>


            </div>

        </div>
        <!-- TabPane -->
        <ul class="nav nav-pills m-t-30 m-b-30 container">
            <li class="nav-item">
                <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false" onclick="showeach()">
                အကြွေးကျန် Voucher
                </a>
            </li>
            <li class="nav-item">
                <a href="#navpills-2" class="nav-link" data-toggle="tab" aria-expanded="false" onclick="hideeach()">
                ရှင်းလင်းပြီး Voucher
                </a>
            </li>
        </ul>
    <!--modal Begin Each Description Modal-->
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title float-left">Payment Description</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="md-form">
                <textarea id="dest" name="dest" class="md-textarea form-control" rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary ml-3">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
        </div>
        </div>
        </div>
    </div>
        <!-- end Each Desctiption modal-->
        <!-- End TabPane -->
        <div class="tab-content br-n pn">
            <div id="navpills-1" class="tab-pane active">
                <div class="row justify-content-center">
                    <div class="container col-md-12">
                        <div class="card">
                            <div class="card-body shadow">
                                <!-- Begin -->
                                <table class="table table-striped text-black">
                                    <thead class="bg-info text-white">
                                    <tr>
                                        <th>Select</th>
                                        <th>No</th>

                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Repayment Date</th>
                                        <th>Credit Amount</th>
                                        <th>Pay History</th>

                                        <th>Detail</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        @foreach ($credit as $credits)
                                        @if($credits->paid_status == 0)
                                        <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="exampleCheck{{$credits->purchase_id}}" name="checkk" onchange="myForm('{{$credits->purchase_id}}','{{$credits->credit_amount}}','{{$credits->id}}','{{$credits->supplier_id}}')">
                                                <label class="form-check-label" for="exampleCheck{{$credits->purchase_id}}" ></label>
                                            </div>
                                        </td>
                                        <td>{{$i++}}</td>
                                        <td>{{$credits->purchase->supplier_name}}</td>
                                        <td>{{$credits->supplier->phone_number}}</td>
                                        <td>{{$credits->repay_date}}</td>
                                        <td>{{$credits->credit_amount}}</td>
                                        <td>
                                            <a class="btn btn-primary" data-toggle="collapse" href="#leftcredit{{$credits->purchase_id}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Pay Credit</a>
                                        </td>
                                        <td><a href="" class="btn btn-warning" data-target="#purchase_detail{{$credits->id}}" data-toggle="modal" onclick="getPurchaseData('{{$credits->id}}')">Purchase Detail</a></td>

                                    </tr>
                                    {{-- Begin Collapse --}}
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="5"><div class="collapse out container mr-5" id="leftcredit{{$credits['purchase_id']}}"><div class="row">
                                            <div class="col-md-3">
                                                <div>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Repay Date</label>
                                                @foreach($paypay as $pays)
                                                @if($pays->paid_status == 0)
                                                @if($pays->purchase_id == $credits->purchase_id)
                                                @if($pays->pay_amount != 0)
                                                <div>
                                                    {{$pays->pay_date}}
                                                </div>
                                                @endif
                                                @endif
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="col-md-3">
                                                <label>Pay Amount</label>
                                                @foreach($paypay as $pays)
                                                @if($pays->paid_status == 0)
                                                @if($pays->purchase_id == $credits->purchase_id)
                                                @if($pays->pay_amount != 0)
                                                <div>
                                                    {{$pays->pay_amount}}
                                                </div>
                                                @endif
                                                @endif
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="col-md-3">
                                                <label>Left Amount</label>
                                                @foreach($paypay as $pays)
                                                @if($pays->paid_status == 0)
                                                @if($pays->purchase_id == $credits->purchase_id)
                                                @if($pays->pay_amount != 0)
                                                <div>
                                                {{$pays->left_amount}}
                                                </div>
                                                @endif
                                                @endif
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        </div></div></td>

                                            </tr>
                                    <!-- End Collapse -->
                                    @endif
                                    @endforeach
                                    </tbody>
                                    </table>
                                <!-- End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- Begin finish pay Voucher -->
            <div id="navpills-2" class="tab-pane">
                <div class="row justify-content-center">
                    <div class="container col-md-12">
                        <div class="card">
                            <div class="card-body shadow">
                            <!-- Begin -->
                            <table class="table table-striped text-black">
                                    <thead class="bg-info text-white">
                                    <tr>


                                        <th>No</th>

                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Repayment Date</th>
                                        <th>Credit Amount</th>
                                        <th>Pay History</th>
                                        <th class="text-center">Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        @foreach ($credit as $credits)
                                        @if($credits->paid_status == 1)
                                        <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$credits->purchase->supplier_name}}</td>
                                        <td>{{$credits->supplier->phone_number}}</td>
                                        <td>{{$credits->repay_date}}</td>
                                        <td>{{$credits->credit_amount}}</td>
                                        <td>
                                            <a class="btn btn-primary" data-toggle="collapse" href="#leftcredit{{$credits->purchase_id}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Pay Credit</a>
                                        </td>
                                        <td><a href="" class="btn btn-warning" disabled>Voucher Detail</a></td>
                                    </tr>
                                    {{-- Begin Collapse --}}
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="5"><div class="collapse out container mr-5" id="leftcredit{{$credits['purchase_id']}}"><div class="row">
                                            <div class="col-md-3">
                                                <div>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Repay Date</label>
                                                @foreach($paypay as $pays)
                                                @if($pays->paid_status == 1)
                                                @if($pays->purchase_id == $credits->purchase_id)
                                                @if($pays->pay_amount != 0)
                                                <div>
                                                    {{$pays->pay_date}}
                                                </div>
                                                @endif
                                                @endif
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="col-md-3">
                                                <label>Pay Amount</label>
                                                @foreach($paypay as $pays)
                                                @if($pays->paid_status == 1)
                                                @if($pays->purchase_id == $credits->purchase_id)
                                                @if($pays->pay_amount != 0)
                                                <div>
                                                    {{$pays->pay_amount}}
                                                </div>
                                                @endif
                                                @endif
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="col-md-3">
                                                <label>Left Amount</label>
                                                @foreach($paypay as $pays)
                                                @if($pays->paid_status == 1)
                                                @if($pays->purchase_id == $credits->purchase_id)
                                                @if($pays->pay_amount != 0)
                                                <div>
                                                {{$pays->left_amount}}
                                                </div>
                                                @endif
                                                @endif
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        </div></div></td>

                                            </tr>
                                    <!-- End Collapse -->
                                    @endif
                                    @endforeach
                                        </tbody>
                                    </table>
                            <!-- End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <!-- End Finish pay Voucher Credit -->
    @foreach ($credit as $credits)
    <!-- Begin Purchase Modal -->
    <div class="modal fade bd-example-modal-lg" id="purchase_detail{{$credits->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="font-weight-bold">Purchase Details</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row bg-info">
                        <div class="col-md-3">
                            <label class="text-white">Supplier Name</label>
                        </div>
                        <div class="col-md-3">
                            <label  class="text-white">Total Quantity</label>
                        </div>
                        <div class="col-md-3">
                            <label  class="text-white">Total Price</label>
                        </div>
                        <div class="col-md-3">
                            <label  class="text-white">Purchase Date</label>
                        </div>
                    </div>
                    <!-- <hr> -->
                    <div id="purchase_place{{$credits->id}}">

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End Purchase Modal -->
    @endforeach

        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function()
    {
        $('#clear').hide();
    });

    function myForm(valueone,value,id,supid){
    $('#vouid').val(valueone);
    // alert(valueone);
        $('#supid').val(supid);
    $('#vou_id').val(valueone);
    // $('#dueamt').val(value);
    $('#due_amt').val(value);
    $('#dueamt').val(value);


    }
function showdue(){
    var amt = $('#dueamt').val();
    var pay = $('#payamt').val();
    // alert(amt+"---"+pay);
    // if(parseInt(amt) < parseInt(pay))
    // {
    //     swal({
    //         icon: 'error',
    //         title: 'Pay Amount Invalid!',
    //         text: ' Pay Amount is greater than Due Amount!!!',
    //     });
    //     $('#payamt').val("");
    // }
    // else
    // {
        $('#dueamt').val($('#due_amt').val()-$('#payamt').val());
    // }

}
function hideeach()
{
  $('#eacheach').hide();
  $('#clear').show();

}
function showeach()
{
  $('#eacheach').show();
  $('#clear').hide();
}
function calrepay()
{
  var Tot = $('#total').val();
  var Rep = $('#repay').val();
  $('#repayremark').val(Tot - Rep);
}

function getPurchaseData(id)
{
    $.ajax({

            type:'POST',

            url:'/getPurchaseData',

            data:{
            "_token":"{{csrf_token()}}",
            "credit_list_id":id,
            },

            success:function(data){
                var htmlpur = "";
                htmlpur +=`
                <div class="row mt-4">
                    <div class="col-md-3">
                        ${data.supplier_name}
                    </div>
                    <div class="col-md-3">
                        ${data.total_quantity}
                    </div>
                    <div class="col-md-3">
                        ${data.total_price}
                    </div>
                    <div class="col-md-3">
                        ${data.purchase_date}
                    </div>
                </div>
                `;
                $('#purchase_place'+id).html(htmlpur);
            }
    });
}

</script>
@endsection

