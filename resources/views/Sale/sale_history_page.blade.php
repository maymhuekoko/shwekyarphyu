@extends('master')

@section('title','Sale History Page')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h4 class="text-themecolor m-b-0 m-t-0">@lang('lang.sale_history')</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">@lang('lang.back_to_dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('lang.sale_history')</li>
    </ol>
</div>

@endsection

@section('content')
<section id="plan-features">
    <div class="row ml-2 mr-2">
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                            <span class="h3 font-weight-normal mb-0 text-info" style="font-size: 20px;">{{$total_sales}}  @lang('lang.ks')</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape text-white rounded-circle shadow" style="background-color:#473C70;">
                                <i class="fas fa-hand-holding-usd"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-success font-weight-normal text-sm">
                        <span>@lang('lang.all_time_sale')</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="h3 font-weight-normal mb-0 text-info" style="font-size: 20px;">{{$daily_sales}} @lang('lang.ks')</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape text-white rounded-circle shadow" style="background-color:#473C70;">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-success font-weight-normal text-sm">
                        <span>@lang('lang.today') @lang('lang.sales')</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="h2 font-weight-normal mb-0 text-info" style="font-size: 25px;">{{$weekly_sales}} @lang('lang.ks')</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape text-white rounded-circle shadow" style="background-color:#473C70;">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-success font-weight-normal text-sm">
                        <span>@lang('lang.this') @lang('lang.week')</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                            <span class="h3 font-weight-normal mb-0 text-info" style="font-size: 20px;">{{$monthly_sales}} @lang('lang.ks')</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape text-white rounded-circle shadow" style="background-color:#473C70;">
                                <i class="fas fa-hand-holding-usd"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-success font-weight-normal text-sm">
                        <span>@lang('lang.this') @lang('lang.month')</span>
                        </p>
                    </div>
                </div>
            </div>
    </div>

    <div class="row ml-4 mt-3">
        <form action="{{route('search_sale_history')}}" method="POST" class="form">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <label class="control-label font-weight-bold">@lang('lang.from')</label>
                    <input type="date" name="from" class="form-control" required>
                </div>
                
                <div class="col-md-5">
                    <label class="font-weight-bold">@lang('lang.to')</label>
                    <input type="date" name="to" class="form-control" required>
                </div>

                <div class="col-md-2 m-t-30">
                    <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="@lang('lang.search')">
                </div>
            </div>
        </form>
        @if ($search_sales !=0)
        <p class="text-right font-weight-normal text-danger ml-5 mt-4 pt-2">Search Sales = <span> {{$search_sales}} ကျပ်</span></p>            
        @endif

    </div>
    <br/>

    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive text-black" id="slimtest2">
                            <table class="table" id="item_table">
                                <thead>
                                    <tr>
                                        <th class="text-black">#</th>
                                        <th class="text-black">@lang('lang.voucher') @lang('lang.number')</th>
                                        <th class="text-black">@lang('lang.voucher') @lang('lang.date')</th>
                                        <th class="text-black">@lang('lang.name')</th>
                                        <th class="text-black">@lang('lang.total') @lang('lang.quantity')</th>
                                        <th class="text-black">@lang('lang.total') @lang('lang.price')</th>
                                        <th class="text-black">Discount</th>
                                        <th class="text-black">@lang('lang.details')</th>
                                    </tr>
                                </thead>
                                <tbody id="item_list">
                                    <?php
                                        $i = 1;
                                        $name = "Customer"
                                    ?>
                                   @foreach($voucher_lists as $voucher) 
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$voucher->voucher_code}}</td>
                                        <td>{{$voucher->voucher_date}}</td>
                                        <td>{{($voucher->sales_customer_name != "") ? $voucher->sales_customer_name : $name }}</td>
                                        <td>{{$voucher->total_quantity}}</td>
                                        @php
                                            if($voucher->discount > 0){
                                                $total_wif_discount = ($voucher->total_price) - ((int) $voucher->discount);
                                            }
                                            else if ($voucher->discount == "foc"){
                                                $total_wif_discount = 0;
                                            }
                                            else if ($voucher->discount == 0){
                                                $total_wif_discount = $voucher->total_price;
                                            }
                                        @endphp
                                        <td>{{$total_wif_discount}}</td>
                                        <td>{{$voucher->discount}}</td>
                                        <td style="text-align: center;"><a href="{{ route('getVoucherDetails',$voucher->id)}}" class="btn btn-primary" style="color: white;">Details</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')

<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>

<script type="text/javascript">

	$('#item_table').DataTable( {

            "paging":   false,
            "ordering": true,
            "info":     false

    });
        
    $('#slimtest2').slimScroll({
        color: '#00f',
        height: '600px'
    });
	
</script>

@endsection