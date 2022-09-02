@extends('master')

@section('title','Create Purchase')

@section('place')

{{-- <div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">@lang('lang.purchase') @lang('lang.create')</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">@lang('lang.back_to_dashboard')</a></li>
        <li class="breadcrumb-item active">Create Purchase</li>
    </ol>
</div> --}}

@endsection

@section('content')
@php
$from_id = 1;
@endphp
<div class="row page-titles">
    <div class="col-md-12 col-12 align-self-center">
        <h4 class="font-weight-normal">@lang('lang.purchase') @lang('lang.create') (Shwe Kyar Phyu -ပင်ရင်း)</h4>
    </div>
</div>

<div class="row">
    <div class="col-7">
        <div class="card shadow text-black">
            <div class="card-body">
                <h4 class="card-title">@lang('lang.purchase') @lang('lang.create')</h4>

                <form class="form-material m-t-40" method="post" action="{{route('store_purchase')}}" id="store_purchase">
                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold">@lang('lang.purchase_date')</label>
                        <input type="date" name="purchase_date" class="form-control" value="<?= date("Y-m-d"); ?>">
                    </div>

                    {{-- <div class="form-group">

                        <input type="text" name="supp_name" class="form-control" placeholder="Enter Supplier Name">
                    </div> --}}
                    <div class="form-group">
                    <label class="font-weight-bold">@lang('lang.supplier_name')</label>
                    <select class="select_sup form-control" name="supp_name" id="supp_name" >
                        <option></option>
                        @foreach($supplier as $sup)
                        <option value="{{$sup->id}}">{{$sup->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    <!-- Header -->

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>No.</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Unit Name</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                               <label>Qty</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                               <label>Price</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Sub Total</label>
                            </div>
                        </div>
                        <div class="col-md-1">

                        </div>
                    </div>

                    <!-- end header -->
                    <div id="unit_place">
                        <label class="font-weight-bold">Units</label>

                    </div>
                    <div id="total_amt" class="mt-3">
                        <label class="font-weight-bold text-info">Total Amount - <span class="m-2" id="total_place"></span></label>
                    </div>
                    <input type="button" name="btnsubmit" data-target="#storetotal" data-toggle="modal" class="btnsubmit float-right btn btn-primary" value="Save Unit">
                    <div class="modal fade" id="storetotal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-info">
                              <h5 class="modal-title text-white" id="exampleModalLabel">Purchase Pay Method</h5>
                              <label class="font-weight-bold offset-md-3 text-white">Total Amount - <span id="show_total"></span></label>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="row offset-md-2">
                                    <div class="form-check form-check-inline ml-5">
                                        <input class="form-check-input" type="radio" name="pay_method" id="credit_radio" value="1" onclick="credit(this.value)">
                                        <label class="form-check-label text-success" for="credit_radio">Credit</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pay_method" id="cash_radio" value="2" onclick="cash(this.value)">
                                        <label class="form-check-label text-success" for="cash_radio">Cash Down</label>
                                    </div>
                                </div>
                                <div class="form-group m-2" id="credit_all">
                                    <label class="font-weight-bold">Credit Amount</label>
                                    <input type="number" id="credit_amount" name="credit_amount" class="form-control" readonly>
                                </div>
                                {{-- <div class="form-group m-2" id="repay_all">
                                    <label class="font-weight-bold">Repay Date</label>
                                    <input type="date" id="repay_date" name="repay_date" class="form-control">
                                </div> --}}
                                <div class="form-group m-2">
                                    <label class="font-weight-bold">Pay Amount</label>
                                    <input type="number" id="pay_amount" name="pay_amount" class="form-control" onkeyup="cal_credit(this.value)">
                                </div>
                            </div><!-- end modal body div -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary" onclick="submit_store()">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="card shadow text-black">
            <input type="hidden" name="total_amount" id="tot_amt" value="0">
            <div class="form-group m-2">
                <label class="font-weight-bold">@lang('lang.item')</label>
                <select class="p-4 select form-control" name="item" id="counting_unit_select" >
                    <option></option>
                    @foreach ($items as $item)
                        @if ($item->counting_units)
                            @foreach ($item->counting_units as $counting_unit)

                                <option data-unitname="{{$counting_unit->unit_name}}"
                                    data-id="{{$counting_unit->id}}"
                                    data-itemname="{{$item->item_name}}"
                                    data-purchaseprice="{{$counting_unit->purchase_price}}"
                                    data-normalprice="{{$counting_unit->normal_sale_price}}"
                                    data-wholeprice="{{$counting_unit->whole_sale_price}}"
                                    data-orderprice="{{$counting_unit->order_price}}"
                                    data-normalfixed="{{$counting_unit->normal_fixed_percent}}"
                                    data-wholefixed="{{$counting_unit->whole_fixed_percent}}"
                                    data-orderfixed="{{$counting_unit->order_fixed_percent}}"
                                    data-orderfixedflash="{{$counting_unit->order_fixed_flash}}"
                                    data-wholefixedflash="{{$counting_unit->whole_fixed_flash}}"
                                    data-normalfixedflash="{{$counting_unit->normal_fixed_flash}}"

                                    value="{{ $counting_unit->id }}">
                                    {{ $counting_unit->unit_code }} &nbsp; &nbsp; - &nbsp; &nbsp;{{ $counting_unit->unit_name }}&nbsp;&nbsp;-  ၀ယ်စျေး - {{$counting_unit->purchase_price}}

                                </option>
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group m-2">
                <label class="font-weight-bold">@lang('lang.quantity')</label>
                <input type="number" id="qty" class="form-control" onkeyup="calculate_total(this.value)">
            </div>





            <div class="form-group m-2">
                <label class="font-weight-bold">@lang('lang.enter_purchase_price')</label>
                <input type="number" id="price" class="form-control">
            </div>

            <div class="form-actions m-2">
              {{-- <button type="submit" class="btn btn-success float-right" id="add">
                <i class="fa fa-check"> </i> @lang('lang.add')
            </button> --}}
            <a href="#" class="btn btn-success float-right px-4" id="addpurchase">@lang('lang.add')</a>

            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="add_purchase_modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">စျေးနှုန်းပြောင်းလဲရှိသည်.</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>

            <div class="modal-body">
                <form>
                    @csrf
                    <input type="hidden" name="unit_id" id="unit_id">

                    <h3 id="test" class="font-weight-bold text-center"></h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="font-weight-bold text-center">ယခင်စျေး</h3>
                            <div class="form-group row mt-4">
                                <label class="control-label text-right col-md-3">@lang('lang.purchase_price')</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="purchase_price" id="old_purchase_price">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">@lang('lang.normal_sale_price')</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="old_normal_sale_price" id="old_normal_sale_price">

                                </div>
                            </div>
                            <div class="form-group row" style="margin-top: 100px;">
                                <label class="control-label text-right col-md-3">@lang('lang.whole_sale_price')</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="whole_sale_price" id="old_whole_sale_price">

                                </div>
                            </div>
                            <div class="form-group row" style="margin-top: 100px;">
                                <label class="control-label text-right col-md-3">@lang('lang.order') @lang('lang.price')</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="order_price" id="old_order_price">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 class="font-weight-bold text-center">ယခုစျေး</h3>
                            <div class="form-group row mt-4">
                                <label class="control-label text-right col-md-3">@lang('lang.purchase_price')</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" value="0" name="purchase_price" id="purchase_price">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">@lang('lang.normal_sale_price')</label>
                                <div class="col-md-9">
                                    {{-- <input type="number" value="0"  class="form-control calculatepercent" name="normal_sale_price" id="normal_sale_price"> --}}
                                    <input type="number" name="normal_sale_price" id="normal_sale_price" class="form-control calculatepercent" data-type="normal" data-action="pricetopercent" placeholder="@lang('lang.enter_normal_sale_price')">
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-3">

                                </div>
                                <div class=" col-5">
                                    <input type="checkbox" class="custom-control-input" name="normal_fixed" id="normal_fixed" value="1"
                                    >
                                    <label class="font-weight-bold" for="normal_fixed">Fiexd</label>
                                    <label class="font-weight-bold float-right">%</label>
                                </div>
                                <div class=" col-4">

                                    <input type="number" name="normal_percent" class="form-control calculatepercent  mb-3" data-action="percenttoprice" data-type="normal" id="normal_percent">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">@lang('lang.whole_sale_price')</label>
                                <div class="col-md-9">
                                    {{-- <input type="number" value="0"  class="form-control calculatepercent" name="whole_sale_price" id="whole_sale_price"> --}}
                                    <input type="number" name="whole_sale_price" id="whole_sale_price" class="form-control calculatepercent" data-type="whole" data-action="pricetopercent" placeholder="@lang('lang.enter_whole_sale_price')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">

                                </div>
                                <div class=" col-5">
                                    <input type="checkbox" class="custom-control-input" name="whole_fixed" id="whole_fixed" value="1"
                                    >
                                    <label class="font-weight-bold" for="whole_fixed">Fiexd</label>
                                    <label class="font-weight-bold float-right">%</label>
                                </div>
                                <div class=" col-4">
                                    <input type="number" name="whole_percent" id="whole_percent" class="form-control calculatepercent" data-action="percenttoprice" data-type="whole">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">@lang('lang.order') @lang('lang.price')</label>
                                <div class="col-md-9">
                                    {{-- <input value="0" type="number" class="form-control calculatepercent" name="order_price" id="order_price"> --}}
                                    <input type="number" name="order_sale_price" id="order_sale_price" class="form-control calculatepercent" data-type="order" data-action="pricetopercent" placeholder="@lang('lang.enter_customer_order_sale_price')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">

                                </div>
                                <div class=" col-5">
                                    <input type="checkbox" class="custom-control-input" name="order_fixed" id="order_fixed" value="1"
                                    >
                                    <label class="font-weight-bold" for="order_fixed">Fiexd</label>
                                    <label class="font-weight-bold float-right">%</label>
                                </div>
                                <div class=" col-4">
                                    <input type="number" name="order_percent"
                                    id="order_percent" class="form-control calculatepercent" data-action="percenttoprice" data-type="order">
                                </div>
                            </div>
                        </div>
                    </div>


                    <input type="submit" name="" id="change_price"  class="btnsubmit float-right btn btn-primary" value="@lang('lang.save')">

                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')

<script type="text/javascript">

    $(document).ready(function(){

        $(".select2").select2();
        $(".select").select2({
            placeholder:"ရှာရန်",
        });
        $(".select_sup").select2({
            placeholder:"Choose Supplier Name",
        });
        $('#credit_all').hide();
        $('#repay_all').hide();

        $('.calculatepercent').keyup(function(){
        // alert('hello');
            var type = $(this).data('type');
            var action = $(this).data('action');
            var value = $(this).val();
            var purchase_prc = $('#purchase_price').val();


            if(action=="pricetopercent"){
                var percent = ((value-purchase_prc)/purchase_prc)*100;
                var id = type+"_percent";
                $("#"+id).val(Math.round(percent));
            }
            else{
                var price = parseInt(purchase_prc) +(purchase_prc * (value/100));
                var id = type+"_sale_price";
                $("#"+id).val(price);
            }

})
        showmodal();
    });


    $('#addpurchase').click(function(){
        // alert($('#normal_percent').val());
        $('#normal_percent').val(0);
        $('#whole_percent').val(0);
        $('#order_percent').val(0);
        $('#order_sale_price').val('Enter Order Sale Price');
        var now_price = $('#price').val();
        var id=  $( "#counting_unit_select option:selected" ).data('id');
        var purchaseprice=  $( "#counting_unit_select option:selected" ).data('purchaseprice');
        var normalprice=  $( "#counting_unit_select option:selected" ).data('normalprice');
        var wholeprice=  $( "#counting_unit_select option:selected" ).data('wholeprice');
        var orderprice=  $( "#counting_unit_select option:selected" ).data('orderprice');
        var normalfixed=  $( "#counting_unit_select option:selected" ).data('normalfixed');
        var wholefixed=  $( "#counting_unit_select option:selected" ).data('wholefixed');
        var orderfixed=  $( "#counting_unit_select option:selected" ).data('orderfixed');

        var normalfixedflash=  $( "#counting_unit_select option:selected" ).data('normalfixedflash');
        var wholefixedflash=  $( "#counting_unit_select option:selected" ).data('wholefixedflash');
        var orderfixedflash=  $( "#counting_unit_select option:selected" ).data('orderfixedflash');

       if(now_price!=purchaseprice){
           if(normalfixedflash){
             var n_price =( parseInt(now_price)+ (parseInt(now_price)*normalfixed/100) );
             $('#normal_sale_price').val(n_price);
           }
           if(wholefixedflash){
             var w_price =( parseInt(now_price)+ (parseInt(now_price)*wholefixed/100) );
             $('#whole_sale_price').val(w_price);
           }
           if(orderfixedflash){
             var o_price =( parseInt(now_price)+ (parseInt(now_price)*orderfixed/100) );
             $('#order_price').val(o_price);
           }

           $('#unit_id').val(id);
           $('#purchase_price').val(now_price);
           $('#old_purchase_price').val(purchaseprice);
           $('#old_normal_sale_price').val(normalprice);
           $('#old_whole_sale_price').val(wholeprice);
           $('#old_order_price').val(orderprice);
           addpurchase();

        $('#add_purchase_modal').modal('show');
       }else{
           addpurchase();
       }
    })

    $('#change_price').click(function(e){
        // alert('hello');
        e.preventDefault();
          var unit_id=  $('#unit_id').val();
          var purchase_price= $('#purchase_price').val();
          var normal_price=  $('#normal_sale_price').val();
          var whole_price=   $('#whole_sale_price').val();
          var order_price=   $('#order_sale_price').val();
        //   var normal_fixed = $('#normal_fixed').val();
          var normal_percent = $('#normal_percent').val();
        //   var whole_fixed = $('#whole_fixed').val();
          var whole_percent = $('#whole_percent').val();
        //   var order_fixed = $('#order_fixed').val();
          var order_percent = $('#order_percent').val();
        //   alert(normal_fixed);
        //   alert(normal_percent);
          console.log(unit_id,purchase_price,normal_price,whole_price,order_price);
        //   alert(order_price);

          if($.trim(unit_id) == '' || $.trim(purchase_price) <= 0 || $.trim(normal_price) <= 0 || $.trim(whole_price) <= 0 || $.trim(order_price) < 0)
    {
        swal({
            title:"Failed!",
            text:"Please fill all basic unit field",
            icon:"error",
            timer: 3000,
        });

    }else{
        $.ajax({

            type:'POST',

            url:'/purchaseprice/update',

            data:{
                "_token":"{{csrf_token()}}",
                "unit_id": unit_id,
                "purchase_price": purchase_price,
                "normal_price": normal_price,
                "whole_price": whole_price,
                "order_price": order_price,
                // "normal_fixed" : normal_fixed,
                "normal_percent" : normal_percent,
                // "whole_fixed" : whole_fixed,
                "whole_percent" : whole_percent,
                // "order_fixed" : order_fixed,
                "order_percent" : order_percent,
            },

            success:function(data){
                // alert('hellooo');
               if(data){
                modalformclear();
                $('#add_purchase_modal').modal('hide');

                swal({
                    title:"Success!",
                    text:"Successfully changed!",
                    icon:"info",
                    timer: 3000,
                });
               }else{
                swal({
                    title:"Failed!",
                    text:"Please fill all basic unit field",
                    icon:"error",
                    timer: 3000,
                });
               }
            },


        });

    }

          $.ajax({

            type:'POST',

            url:'/getCustomerInfo',

            data:{
                "_token":"{{csrf_token()}}",
                "customer_id":value,
            },

            success:function(data){

                $("#phone").val(data.phone);

                $("#address").val(data.address);
            },


            });
    })

    function modalformclear (){
        $('#purchase_price').val(null);
        $('#old_purchase_price').val(null);
        $('#normal_sale_price').val(null);
        $('#whole_sale_price').val(null);
        $('#order_price').val(null);
    }

    var count = 0

    function addpurchase(){

    // event.preventDefault();
    var counting_unit_select=  $( "#counting_unit_select option:selected" ).data('unitname');
    var html = "";

    count + 1;

    var qty = $('#qty').val();

    var unit_id =  $( "#counting_unit_select option:selected" ).data('id');

    var unit_name =   $( "#counting_unit_select option:selected" ).data('unitname');

    var item =$( "#counting_unit_select option:selected" ).data('itemname');

    var price = $('#price').val();

    var total = price * qty;

    var hid_total = $('#tot_amt').val();

    var last = parseInt(total) + parseInt(hid_total);

    var sub = parseInt(price)*qty;

    if($.trim(qty) == '' || $.trim(unit_id) == '' || $.trim(unit_id) =='')
    {
        swal({
            title:"Failed!",
            text:"Please fill all basic unit field",
            icon:"info",
            timer: 3000,
        });

    }else{
        var cal_total = total;
        var total_qty = 0;
        total_qty += qty;
        var item={id:parseInt(unit_id),unit_name:unit_name,qty:qty,price:price,item_name:item,sub_total:sub};
        var totallast = {sub_total:cal_total,total_qty:parseInt(qty)};
        var myprcart = localStorage.getItem('myprcart');
        var my_pr_total = localStorage.getItem('prTotal');
        if(myprcart == null ){

            myprcart = '[]';

            var myprcartobj = JSON.parse(myprcart);

            myprcartobj.push(item);

            localStorage.setItem('myprcart',JSON.stringify(myprcartobj));

            }else{

            var myprcartobj = JSON.parse(myprcart);

            var hasid = false;

            $.each(myprcartobj,function(i,v){

                if(v.id == unit_id ){

                    hasid = true;
                    v.sub_total = parseInt(v.price) * parseInt(v.qty);
                    console.log(v.each_sub);
                }
            })

            if(!hasid){

                myprcartobj.push(item);
            }

            localStorage.setItem('myprcart',JSON.stringify(myprcartobj));
        }
        if(my_pr_total == null ){

            localStorage.setItem('prTotal',JSON.stringify(totallast));

        }else{

            var pr_total_obj = JSON.parse(my_pr_total);

            pr_total_obj.sub_total = cal_total + pr_total_obj.sub_total;

            pr_total_obj.total_qty = parseInt(qty) + parseInt(pr_total_obj.total_qty);

            localStorage.setItem('prTotal',JSON.stringify(pr_total_obj));
        }
        showmodal();

        // $('#tot_amt').val(last);
        // $('#total_place').html(last);
        // $('#show_total').html(last);


        formClear();
    }
    }

    $.ajax({

type:'POST',

url:'/getCustomerInfo',

data:{
    "_token":"{{csrf_token()}}",
    "customer_id":value,
},

success:function(data){

    $("#phone").val(data.phone);

    $("#address").val(data.address);
},


});

    function remove_education_fields(rid) {

        console.log(rid);

        // $('#removeclass_' + rid).remove();
        var myprcart = localStorage.getItem('myprcart');
        var my_pr_total = localStorage.getItem('prTotal');
        var pr_total_obj = JSON.parse(my_pr_total);
        var myprcartobj = JSON.parse(myprcart);
        var item = myprcartobj.findIndex(item =>item.id == rid);
        // alert(item);
        var dele = myprcartobj.filter(dele =>dele.id == rid);
        pr_total_obj.sub_total -= parseInt(dele[0].sub_total);
        myprcartobj.splice(item, 1);
        localStorage.setItem('myprcart',JSON.stringify(myprcartobj));
        localStorage.setItem('prTotal',JSON.stringify(pr_total_obj));
        showmodal();

    }

    function formClear() {

        $('#item').empty();

        $('#unit').empty();

        $( "#item" ).prop( "disabled", true );

        $( "#unit" ).prop( "disabled", true );

        $("#qty").val("");

        $("#price").val("");
    }
function cal_credit(pay)
{
    var total_amt = $('#tot_amt').val();
    var credit = parseInt(total_amt) - parseInt(pay);
    $('#credit_amount').val(credit);
}

function credit(value)
{
    $('#credit_all').show();
    $('#repay_all').show();
}
function cash(value)
{
    $('#credit_all').hide();
    $('#repay_all').hide();
}
function submit_store()
{

    $('#store_purchase').submit();
    localStorage.removeItem('myprcart');
    localStorage.removeItem('prTotal');
}
function showmodal()
{
    var html = "";
    var myprcart = localStorage.getItem('myprcart');
    var my_pr_total = localStorage.getItem('prTotal');
    var pr_total_obj = JSON.parse(my_pr_total);
    var myprcartobj = JSON.parse(myprcart);
    var jj=1;
    $.each(myprcartobj,function(i,v){
        html+=`<div class="form-group" id="removeclass_${i}">
        <input type="hidden" id="each_amt" value="${i}">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                            <p>${jj++}</p>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="hidden" name="unit[]" value="${v.id}">
                                <input type="text" class="form-control font-weight-bold text-dark" value="${v.unit_name}" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="number" class="form-control font-weight-bold text-dark" id="qty${v.id}" name="qty[]" value="${v.qty}" onkeyup="change_amt('${v.id}',this.value)">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" class="form-control font-weight-bold text-dark" id="price${v.id}" name="price[]" value="${v.price}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="sub_total[]" class="form-control font-weight-bold text-dark" value="${v.sub_total}" id="sub${v.id}" readonly>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button class="btn-outline-danger" type="button" onclick="remove_education_fields(${v.id});">
                            <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
            </div>`
        });
        $("#unit_place").html(html);
        $('#total_place').html(pr_total_obj.sub_total);
        $('#tot_amt').val(pr_total_obj.sub_total);
        $('#show_total').html(pr_total_obj.sub_total);
}
function change_amt(id,qty)
{
    // alert(qty);
    price = $('#price'+id).val();
    var last_total = 0;
    var last_qty = 0;
    var change_qty = parseInt(qty);
    var myprcart = localStorage.getItem('myprcart');
    var my_pr_total = localStorage.getItem('prTotal');
    var pr_total_obj = JSON.parse(my_pr_total);
    var myprcartobj = JSON.parse(myprcart);
    var item = myprcartobj.filter(item =>item.id == id);
    $.each(myprcartobj,function(i,v){
        if(myprcartobj[i].id == id)
        {
            pr_total_obj.total_qty -= parseInt(myprcartobj[i].qty);
            pr_total_obj.total_qty = parseInt(pr_total_obj.total_qty)+change_qty;
            pr_total_obj.sub_total -= parseInt(myprcartobj[i].sub_total);

            myprcartobj[i].qty = change_qty;
            myprcartobj[i].sub_total = myprcartobj[i].price * change_qty;
            pr_total_obj.sub_total +=parseInt(myprcartobj[i].sub_total);

            localStorage.setItem('myprcart',JSON.stringify(myprcartobj));
            localStorage.setItem('prTotal',JSON.stringify(pr_total_obj));
        }


    });
    // pr_total_obj.total_qty += parseInt(qty);
    // pr_total_obj.sub_total = qty * price;
    // localStorage.setItem('prTotal',JSON.stringify(pr_total_obj));

    showmodal();


}



</script>


@endsection
