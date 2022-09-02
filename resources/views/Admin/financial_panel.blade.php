@extends('master')

@section('title','Financial Report')

@section('place')
{{--
<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">@lang('lang.financial')</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">@lang('lang.back_to_dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('lang.financial')</li>
    </ol>
</div> --}}

@endsection

@section('content')

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <div class="card ">
                <div class="card-body">
                    <h3 class="text-center font-weight-bold">၀င်ငွေစုစုပေါင်း</h3>
                    <div class="progress" id="inc_total_percent">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <span class="font-weight-bold mt-1 float-right" id="inc_total"></span>
                </div>
            </div>
            <div class="row">
            <div class="col-md-4">
                <div class="card py-5 px-2 mt-4">
            	<h2 class="card-title text-success font-weight-bold">@lang('lang.financial') @lang('lang.list')</h2>
                <ul class="nav nav-pills nav-tabs m-t-30 m-b-30">
                    <li class=" nav-item">
                        <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">@lang('lang.daily')</a>
                    </li>
                    <li class="nav-item">
                        <a href="#navpills-2" class="nav-link" data-toggle="tab" aria-expanded="false">@lang('lang.weekly')</a>
                    </li>
                    <li class="nav-item">
                        <a href="#navpills-3" class="nav-link" data-toggle="tab" aria-expanded="false">@lang('lang.monthly')</a>
                    </li>
                </ul><br/>
                <div class="tab-content br-n pn">
                    <div id="navpills-1" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                     <label class="control-label text-success font-weight-bold">@lang('lang.daily')</label>
                                    <input type="date" class="form-control" id="daily" value="<?= date("Y-m-d"); ?>">
                                </div>
                            </div>

                            <div class="col-md-3 pull-right mt-3">
                                <button class="btn btn-success btn-submit" type="submit" onclick="showDailySale()">
                                	@lang('lang.search')
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="navpills-2" class="tab-pane">
                    	<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label text-success font-weight-bold">@lang('lang.weekly')</label>
                                    <select class="form-control custom-select" id="weekly">
                                        <option value="">@lang('lang.select_week')</option>
                                        <option value="1">@lang('lang.one_week')</option>
                                        <option value="2">@lang('lang.two_week')</option>
                                        <option value="3">@lang('lang.three_week')</option>
                                        <option value="4">@lang('lang.four_week')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 pull-right mt-3">
                                <button class="btn btn-success btn-submit" type="submit" onclick="showWeeklySale()">
                                	@lang('lang.search')
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="navpills-3" class="tab-pane">
                    	<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label text-success font-weight-bold">@lang('lang.monthly')</label>
                                    <select class="form-control custom-select" id="monthly">
                                        <option value="">@lang('lang.select_month')</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 pull-right mt-3">
                                <button class="btn btn-success btn-submit" type="submit" onclick="showMonthlySale()">
                                	@lang('lang.search')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-8">

               <div class="row">
                <div class="col-md-6">
                    <div class="card ">
                        <button class="btn light default" onclick="total_income()">
                        <div class="card-body">
                            <h3 class="text-center font-weight-bold">ရောင်းရငွေ</h3>
                            <div class="progress" id="sale_money_percent">
                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                            <span class="font-weight-bold mt-1 float-right" id="sale_money"></span>
                        </div>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <button class="btn light default" onclick="other_income()">
                        <div class="card-body">
                            <h3 class="text-center font-weight-bold">အခြား၀င်ငွေ</h3>
                        <div class="progress" id="other_inc_percent">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <span class="font-weight-bold mt-1 float-right" id="other_inc"></span>
                        </div>
                        </button>
                    </div>
                </div>
               </div>
               <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <button class="btn light default" onclick="total_income()">
                        <div class="card-body">
                            <h3 class="text-center font-weight-bold">အရင်း</h3>
                        <div class="progress" id="inv_money_percent">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <span class="font-weight-bold mt-1 float-right" id="inv_money"></span>
                        </div>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <button class="btn light default" onclick="other_expense()">
                        <div class="card-body">
                            <h3 class="text-center font-weight-bold">အခြားအသုံးစရိတ်</h3>
                        <div class="progress" id="other_exp_percent">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <span class="font-weight-bold mt-1 float-right" id="other_exp"></span>
                        </div>
                        </button>
                    </div>
                </div>
               </div>
               <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <button class="btn light default" onclick="total_income()">
                        <div class="card-body">
                            <h3 class="text-center font-weight-bold">စုစုပေါင်းအမြတ်</h3>
                        <div class="progress" id="total_profit_percent">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <span class="font-weight-bold mt-1 float-right" id="total_profit"></span>
                        </div>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <button class="btn light default" onclick="">
                        <div class="card-body">
                            <h3 class="text-center font-weight-bold">အသားတင်မြတ်ငွေ</h3>
                        <div class="progress" id="net_profit_percent">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <span class="font-weight-bold mt-1 float-right" id="net_profit"></span>
                        </div>
                        </button>
                    </div>
                </div>
               </div>
        </div>
    </div>
     </div>
    </div>

    <div class="row" id="hide_date">
        <div class="col-md-3">
            <h4 class="text-success font-weight-bold">
                @lang('lang.from')
                <input type="date" name="from_date" id="from_date" class="border border-light text-secondary ml-2">
            </h4>
        </div>
        <div class="col-md-3">
            <h4 class="text-success font-weight-bold">
                @lang('lang.to')
                <input type="date" name="to_date" id="to_date" class="border border-light text-secondary ml-2">
            </h4>
        </div>
        <div class="col-md-4">
            <button class="btn btn-success" id="date_fil" onclick="fil_date()">
                @lang('lang.search')
            </button>
        </div>
    </div>
        <div class="card mt-3" id="report">
        	<div class="card-body">
        		<div class="row mt-2">
	                <div class="col-md-6">
	                    <h4 class="text-success font-weight-bold">
	                    	@lang('lang.total') @lang('lang.sales') -
	                    	<span class="badge badge-pill badge-success" id="total_sales"></span>
	                    </h4>
	                </div>
	                <div class="col-md-6">
	                    <h4 class="text-success font-weight-bold float-right">
	                    	@lang('lang.total') @lang('lang.profit') -
	                    	<span class="badge badge-pill badge-success" id="profit"></span>
	                    </h4>
	                </div>

	                <div class="col-md-12 mt-3">
	                    <table class="table" id="vou_table">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold text-success">
                                    	@lang('lang.voucher') @lang('lang.number')
                                    </th>
                                    <th class="font-weight-bold text-success">
                                    	@lang('lang.total') @lang('lang.amount')
                                    </th>
                                    <th class="font-weight-bold text-success">
                                    	@lang('lang.total') @lang('lang.quantity')
                                    </th>
                                    <th class="font-weight-bold text-success">
                                    	@lang('lang.date')
                                    </th>
                                    <th class="font-weight-bold text-success">
                                    	@lang('lang.action')
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="sale_table">

                            </tbody>
                        </table>
	                </div>
	            </div>
        	</div>
        </div>
        <div class="card mt-3" id="inc_exp">
        	<div class="card-body">
        		<div class="row mt-2">
	                {{-- <div class="col-md-6">
	                    <h4 class="text-success font-weight-bold">
	                    	@lang('lang.total') @lang('lang.sales') -
	                    	<span class="badge badge-pill badge-success" id="total_sales"></span>
	                    </h4>
	                </div>
	                <div class="col-md-6">
	                    <h4 class="text-success font-weight-bold float-right">
	                    	@lang('lang.total') @lang('lang.profit') -
	                    	<span class="badge badge-pill badge-success" id="profit"></span>
	                    </h4>
	                </div> --}}

	                <div class="col-md-12 mt-3">
	                    <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('lang.income_type')</th>
                                    <th>@lang('lang.period')</th>
                                    <th>@lang('lang.date')</th>
                                    <th>@lang('lang.title')</th>
                                    <th>@lang('lang.description')</th>
                                    <th>@lang('lang.amount')</th>
                                </tr>
                            </thead>
                            <tbody id="inc_exp_table">

                            </tbody>
                        </table>
	                </div>
	            </div>
        	</div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>

	$(document).ready(function() {

        $('#inc_exp').hide();
	    $('#report').hide();
        $('#hide_date').hide();

	});

	function showDailySale() {

        $('#other_inc').empty();

        $('#other_exp').empty();

        $('#other_inc_percent').empty();

        $('#other_exp_percent').empty();

        $('#hide_date').hide();

		$('#total_sales').empty();

        $('#sale_money').empty();

        $('#inv_money').empty();

        $('#net_profit').empty();

        $('#inc_total').empty();

        $('#total_profit').empty();

        $('#sale_money_percent').empty();

        $('#inv_money_percent').empty();

        $('#net_profit_percent').empty();

        $('#inc_total_percent').empty();

        $('#total_profit_percent').empty();

		$('#sale_table').empty();

        $('#inc_exp_table').empty();

		var  daily = $('#daily').val();

        // alert(daily);

		var  type  = 1;

		$.ajax({
           type:'POST',
           url:'/getTotalSaleReport',
           data:{
            "value": daily,
            "type": type,
            "_token":"{{csrf_token()}}"
           },

           	success:function(data){

            	console.log(data);

                // alert(data.voucher_lists);
                $('#inc_exp').hide();

                var inv = data.total_sales - data.total_profit ;

                var net_profit = (data.total_profit + data.other_incomes) - data.other_expenses;

                var income_total = data.total_sales + data.other_incomes ;

                var sale_money_percent = parseInt((data.total_sales/income_total) * 100) ;

                var inv_money_percent = parseInt((inv/income_total) * 100) ;

                var total_profit_percent = parseInt((data.total_profit/income_total) * 100) ;

                var other_inc_percent = parseInt((data.other_incomes/income_total) * 100) ;

                var other_exp_percent = parseInt((data.other_expenses/income_total) * 100) ;

                var net_profit_percent = parseInt((net_profit/income_total) * 100) ;

                var html = '';
                html += `<div class="progress-bar" role="progressbar" style="width: ${sale_money_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${sale_money_percent}%</div>`;

                var html1 = '';
                html1 += `<div class="progress-bar" role="progressbar" style="width: ${inv_money_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${inv_money_percent}%</div>`;

                var html2 = '';
                html2 += `<div class="progress-bar" role="progressbar" style="width: ${total_profit_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${total_profit_percent}%</div>`;

                var html3 = '';
                html3 += `<div class="progress-bar" role="progressbar" style="width: ${other_inc_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${other_inc_percent}%</div>`;

                var html4 = '';
                html4 += `<div class="progress-bar" role="progressbar" style="width: ${other_exp_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${other_exp_percent}%</div>`;

                var html5 = '';
                html5 += `<div class="progress-bar" role="progressbar" style="width: ${net_profit_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${net_profit_percent}%</div>`;

                var html6 = '';
                html6 += `<div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">100%</div>`;

                $('#inc_total').append(income_total).append($('<strong>').text('MMK'));

                $('#inc_total_percent').append(html6);

                $('#net_profit').append(net_profit).append($('<strong>').text('MMK'));

                $('#net_profit_percent').append(html5);

                $('#inv_money').append(inv).append($('<strong>').text('MMK'));

                $('#inv_money_percent').append(html1);

                $('#sale_money').append(data.total_sales).append($('<strong>').text('MMK'));

                $('#sale_money_percent').append(html);

                $('#total_sales').text(data.total_sales);

                $('#total_profit').append(data.total_profit).append($('<strong>').text('MMK'));

                $('#total_profit_percent').append(html2);

                $('#other_inc').append(data.other_incomes).append($('<strong>').text('MMK'));

                $('#other_inc_percent').append(html3);

                $('#other_exp').append(data.other_expenses).append($('<strong>').text('MMK'));

                $('#other_exp_percent').append(html4);

            	$('#profit').text(data.total_profit);

		        $.each(data.voucher_lists,function(i,value){

		            let url = "{{url('/Order/Voucher-Details')}}/"+value.id;

		            let button = `<a href="${url}" class="btn btn-success">@lang('lang.details')</a>`

		            $('#sale_table').append($('<tr>')).append($('<td>').text(value.voucher_code)).append($('<td>').text(value.total_price)).append($('<td>').text(value.total_quantity)).append($('<td>').text(value.voucher_date)).append($('<td>').append($(button)));

		        });

		        $('#report').show();
            }
        });
	}

	function showWeeklySale() {

        $('#other_inc').empty();

        $('#other_exp').empty();

        $('#other_inc_percent').empty();

        $('#other_exp_percent').empty();

        $('#hide_date').show();

		$('#total_sales').empty();

        $('#sale_money').empty();

        $('#inv_money').empty();

        $('#total_profit').empty();

        $('#inc_total').empty();

        $('#net_profit').empty();

        $('#sale_money_percent').empty();

        $('#inv_money_percent').empty();

        $('#net_profit_percent').empty();

        $('#inc_total_percent').empty();

        $('#total_profit_percent').empty();

		$('#sale_table').empty();

        $('#inc_exp_table').empty();

		var  daily = $('#weekly').val();

		var  type  = 2;

		$.ajax({
           type:'POST',
           url:'/getTotalSaleReport',
           data:{
            "value": daily,
            "type": type,
            "_token":"{{csrf_token()}}"
           },

           	success:function(data){

            	console.log(data);

                $('#inc_exp').hide();

                var inv = data.total_sales - data.total_profit ;

                var net_profit = (data.total_profit + data.other_incomes) - data.other_expenses;

                var income_total = data.total_sales + data.other_incomes ;

                var sale_money_percent = parseInt((data.total_sales/income_total) * 100) ;

                var inv_money_percent = parseInt((inv/income_total) * 100) ;

                var total_profit_percent = parseInt((data.total_profit/income_total) * 100) ;

                var other_inc_percent = parseInt((data.other_incomes/income_total) * 100) ;

                var other_exp_percent = parseInt((data.other_expenses/income_total) * 100) ;

                var net_profit_percent = parseInt((net_profit/income_total) * 100) ;

                var html = '';
                html += `<div class="progress-bar" role="progressbar" style="width: ${sale_money_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${sale_money_percent}%</div>`;

                var html1 = '';
                html1 += `<div class="progress-bar" role="progressbar" style="width: ${inv_money_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${inv_money_percent}%</div>`;

                var html2 = '';
                html2 += `<div class="progress-bar" role="progressbar" style="width: ${total_profit_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${total_profit_percent}%</div>`;

                var html3 = '';
                html3 += `<div class="progress-bar" role="progressbar" style="width: ${other_inc_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${other_inc_percent}%</div>`;

                var html4 = '';
                html4 += `<div class="progress-bar" role="progressbar" style="width: ${other_exp_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${other_exp_percent}%</div>`;

                var html5 = '';
                html5 += `<div class="progress-bar" role="progressbar" style="width: ${net_profit_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${net_profit_percent}%</div>`;

                var html6 = '';
                html6 += `<div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">100%</div>`;

                $('#inc_total').append(income_total).append($('<strong>').text('MMK'));

                $('#inc_total_percent').append(html6);

                $('#net_profit').append(net_profit).append($('<strong>').text('MMK'));

                $('#net_profit_percent').append(html5);

                $('#inv_money').append(inv).append($('<strong>').text('MMK'));

                $('#inv_money_percent').append(html1);

                $('#sale_money').append(data.total_sales).append($('<strong>').text('MMK'));

                $('#sale_money_percent').append(html);

                $('#total_sales').text(data.total_sales);

                $('#total_profit').append(data.total_profit).append($('<strong>').text('MMK'));

                $('#total_profit_percent').append(html2);

                $('#other_inc').append(data.other_incomes).append($('<strong>').text('MMK'));

                $('#other_inc_percent').append(html3);

                $('#other_exp').append(data.other_expenses).append($('<strong>').text('MMK'));

                $('#other_exp_percent').append(html4);

            	$('#profit').text(data.total_profit);

		        $.each(data.voucher_lists,function(i,value){

		            let url = "{{url('/Order/Voucher-Details')}}/"+value.id;

		            let button = `<a href="${url}" class="btn btn-success">@lang('lang.details')</a>`

		            $('#sale_table').append($('<tr>')).append($('<td>').text(value.voucher_code)).append($('<td>').text(value.total_price)).append($('<td>').text(value.total_quantity)).append($('<td>').text(value.voucher_date)).append($('<td>').append($(button)));

		        });

		        $('#report').show();
            }
        });
	}

	function showMonthlySale() {

        $('#other_inc').empty();

        $('#other_exp').empty();

        $('#other_inc_percent').empty();

        $('#other_exp_percent').empty();

        $('#hide_date').show();

		$('#total_sales').empty();

        $('#sale_money').empty();

        $('#inv_money').empty();

        $('#total_profit').empty();

        $('#inc_total').empty();

        $('#net_profit').empty();

        $('#sale_money_percent').empty();

        $('#inv_money_percent').empty();

        $('#total_profit_percent').empty();

        $('#inc_total_percent').empty();

        $('#net_profit_percent').empty();

		$('#sale_table').empty();

        $('#inc_exp_table').empty();

		var  daily = $('#monthly').val();

		var  type  = 3;

		$.ajax({
           type:'POST',
           url:'/getTotalSaleReport',
           data:{
            "value": daily,
            "type": type,
            "_token":"{{csrf_token()}}"
           },

           	success:function(data){

            	console.log(data);

                $('#inc_exp').hide();

                var inv = data.total_sales - data.total_profit ;

                var net_profit = (data.total_profit + data.other_incomes) - data.other_expenses;

                var income_total = data.total_sales + data.other_incomes ;

                var sale_money_percent = parseInt((data.total_sales/income_total) * 100) ;

                var inv_money_percent = parseInt((inv/income_total) * 100) ;

                var total_profit_percent = parseInt((data.total_profit/income_total) * 100) ;

                var other_inc_percent = parseInt((data.other_incomes/income_total) * 100) ;

                var other_exp_percent = parseInt((data.other_expenses/income_total) * 100) ;

                var net_profit_percent = parseInt((net_profit/income_total) * 100) ;

                var html = '';
                html += `<div class="progress-bar" role="progressbar" style="width: ${sale_money_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${sale_money_percent}%</div>`;

                var html1 = '';
                html1 += `<div class="progress-bar" role="progressbar" style="width: ${inv_money_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${inv_money_percent}%</div>`;

                var html2 = '';
                html2 += `<div class="progress-bar" role="progressbar" style="width: ${total_profit_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${total_profit_percent}%</div>`;

                var html3 = '';
                html3 += `<div class="progress-bar" role="progressbar" style="width: ${other_inc_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${other_inc_percent}%</div>`;

                var html4 = '';
                html4 += `<div class="progress-bar" role="progressbar" style="width: ${other_exp_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${other_exp_percent}%</div>`;

                var html5 = '';
                html5 += `<div class="progress-bar" role="progressbar" style="width: ${net_profit_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${net_profit_percent}%</div>`;

                var html6 = '';
                html6 += `<div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">100%</div>`;

                $('#inc_total').append(income_total).append($('<strong>').text('MMK'));

                $('#inc_total_percent').append(html6);

                $('#net_profit').append(net_profit).append($('<strong>').text('MMK'));

                $('#net_profit_percent').append(html5);

                $('#inv_money').append(inv).append($('<strong>').text('MMK'));

                $('#inv_money_percent').append(html1);

                $('#sale_money').append(data.total_sales).append($('<strong>').text('MMK'));

                $('#sale_money_percent').append(html);

                $('#total_sales').text(data.total_sales);

                $('#total_profit').append(data.total_profit).append($('<strong>').text('MMK'));

                $('#total_profit_percent').append(html2);

                $('#other_inc').append(data.other_incomes).append($('<strong>').text('MMK'));

                $('#other_inc_percent').append(html3);

                $('#other_exp').append(data.other_expenses).append($('<strong>').text('MMK'));

                $('#other_exp_percent').append(html4);

            	$('#profit').text(data.total_profit);

		        $.each(data.voucher_lists,function(i,value){

		            let url = "{{url('/Order/Voucher-Details')}}/"+value.id;

		            let button = `<a href="${url}" class="btn btn-success">@lang('lang.details')</a>`

		            $('#sale_table').append($('<tr>')).append($('<td>').text(value.voucher_code)).append($('<td>').text(value.total_price)).append($('<td>').text(value.total_quantity)).append($('<td>').text(value.voucher_date)).append($('<td>').append($(button)));

		        });

		        $('#report').show();
            }
        });

	}

function fil_date(){

        $('#other_inc').empty();

        $('#other_exp').empty();
        $('#other_inc_percent').empty();

        $('#other_exp_percent').empty();

		$('#total_sales').empty();

        $('#sale_money').empty();

        $('#inv_money').empty();

        $('#total_profit').empty();

        $('#inc_total').empty();

        $('#net_profit').empty();

        $('#sale_money_percent').empty();

        $('#inv_money_percent').empty();

        $('#total_profit_percent').empty();

        $('#inc_total_percent').empty();

        $('#net_profit_percent').empty();

		$('#sale_table').empty();

    if($('.nav-tabs .active').text() == 'Weekly'){
        // alert('nav2');
        var type = 2;
        var  daily = $('#weekly').val();
    }
    else if($('.nav-tabs .active').text() == 'Monthly'){
        // alert('nav3');
        var type = 3;
        var  daily = $('#monthly').val();
    }

    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();

    $.ajax({
           type:'POST',
           url:'/getTotalSaleReport',
           data:{
            "type": type,
            "value" : daily,
            "from_date" : from_date,
            "to_date" : to_date,
            "_token":"{{csrf_token()}}"
           },

           	success:function(data){
                // alert(data.date_fil_lists);
                $('#inc_exp').hide();
                var inv = data.total_sales - data.total_profit ;

                var net_profit = (data.total_profit + data.other_incomes) - data.other_expenses;

                var income_total = data.total_sales + data.other_incomes ;

                var sale_money_percent = parseInt((data.total_sales/income_total) * 100) ;

                var inv_money_percent = parseInt((inv/income_total) * 100) ;

                var total_profit_percent = parseInt((data.total_profit/income_total) * 100) ;

                var other_inc_percent = parseInt((data.other_incomes/income_total) * 100) ;

                var other_exp_percent = parseInt((data.other_expenses/income_total) * 100) ;

                var net_profit_percent = parseInt((net_profit/income_total) * 100) ;

                var html = '';
                html += `<div class="progress-bar" role="progressbar" style="width: ${sale_money_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${sale_money_percent}%</div>`;

                var html1 = '';
                html1 += `<div class="progress-bar" role="progressbar" style="width: ${inv_money_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${inv_money_percent}%</div>`;

                var html2 = '';
                html2 += `<div class="progress-bar" role="progressbar" style="width: ${total_profit_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${total_profit_percent}%</div>`;

                var html3 = '';
                html3 += `<div class="progress-bar" role="progressbar" style="width: ${other_inc_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${other_inc_percent}%</div>`;

                var html4 = '';
                html4 += `<div class="progress-bar" role="progressbar" style="width: ${other_exp_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${other_exp_percent}%</div>`;

                var html5 = '';
                html5 += `<div class="progress-bar" role="progressbar" style="width: ${net_profit_percent}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">${net_profit_percent}%</div>`;

                var html6 = '';
                html6 += `<div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">100%</div>`;

                $('#inc_total').append(income_total).append($('<strong>').text('MMK'));

                $('#inc_total_percent').append(html6);

                $('#net_profit').append(net_profit).append($('<strong>').text('MMK'));

                $('#net_profit_percent').append(html5);

                $('#inv_money').append(inv).append($('<strong>').text('MMK'));

                $('#inv_money_percent').append(html1);

                $('#sale_money').append(data.total_sales).append($('<strong>').text('MMK'));

                $('#sale_money_percent').append(html);

                $('#total_sales').text(data.total_sales);

                $('#total_profit').append(data.total_profit).append($('<strong>').text('MMK'));

                $('#total_profit_percent').append(html2);

                $('#other_inc').append(data.other_incomes).append($('<strong>').text('MMK'));

                $('#other_inc_percent').append(html3);

                $('#other_exp').append(data.other_expenses).append($('<strong>').text('MMK'));

                $('#other_exp_percent').append(html4);

                    $('#profit').text(data.total_profit);

                    $.each(data.date_fil_lists,function(i,value){

                    let url = "{{url('/Order/Voucher-Details')}}/"+value.id;

                    let button = `<a href="${url}" class="btn btn-success">@lang('lang.details')</a>`

                    $('#sale_table').append($('<tr>')).append($('<td>').text(value.voucher_code)).append($('<td>').text(value.total_price)).append($('<td>').text(value.total_quantity)).append($('<td>').text(value.voucher_date)).append($('<td>').append($(button)));

                });
            $('#report').show();
        }
    });
}

 function total_income(){
    //  alert('hello');
	//  showDailySale();
    if($('.nav-tabs .active').text() == 'Daily'){
        showDailySale();
    }
    else if($('.nav-tabs .active').text() == 'Weekly'){
        // if($('#date_fil').clicked == false){
        //     showWeeklySale();
        // }else{
        //     fil_date();
        // }
        showWeeklySale();
    }
    else if($('.nav-tabs .active').text() == 'Monthly'){
        // if($('#date_fil').clicked == false){
        //     showMonthlySale();
        // }else{
        //     fil_date();
        // }
        showMonthlySale();
    }

 }

function other_income(){
    // alert('income');
        $('#hide_date').hide();

        $('#total_sales').empty();

        $('#sale_table').empty();

        $('#inc_exp_table').empty();

        if($('.nav-tabs .active').text() == 'Weekly'){
        // alert('nav2');
        var type = 2;
        var  daily = $('#weekly').val();
        }
        else if($('.nav-tabs .active').text() == 'Monthly'){
        // alert('nav3');
        var type = 3;
        var  daily = $('#monthly').val();
        }
        else{
            var type = 1;
            var  daily = $('#daily').val();
        }
        $.ajax({
           type:'POST',
           url:'/getTotalIncome',
           data:{
            "value": daily,
            "type": type,
            "_token":"{{csrf_token()}}"
           },

           	success:function(data){
                // alert('hello');
                $('#report').hide();
                $('#inc_exp').show();
                if(data.time == 1){
                $.each(data.income_lists,function(i,value){
                    // if(type == 1){
                    if(value.type == 1 && value.period == 1){
                        var type = 'Fixed';
                        var period = 'Daily';
                        var amount = value.amount;
                        var amount_text = ' ';
                    }
                    else if(value.type == 1 && value.period == 2){
                        var type = 'Fixed';
                        var period = 'Weekly';
                        var amount = parseInt(value.amount/7);
                        var amount_text = '(Divided By 7)';
                    }
                    else if(value.type == 1 && value.period == 3){
                        var type = 'Fixed';
                        var period = 'Monthly';
                        var amount = parseInt(value.amount/30);
                        var amount_text = '(Divided By 30)';
                    }
                    else{
                        var type = 'Variable';
                        var period = 'Monthly';
                        var amount = value.amount;
                        var amount_text = ' ';
                    }

                    $('#inc_exp_table').append($('<tr>')).append($('<td>').text(++i)).append($('<td>').text(type)).append($('<td>').text(period)).append($('<td>').text(value.date)).append($('<td>').text(value.title)).append($('<td>').text(value.description)).append($('<td>').text(amount+' '+amount_text));

                });
                }
                else if(data.time == 2){
                    // alert(data.income_lists);
                    $.each(data.income_lists,function(i,value){

                    if(value.type == 1 && value.period == 1){
                        var type = 'Fixed';
                        var period = 'Daily';
                        var amount = value.amount * 7;
                        var amount_text = '(Mutiplied By 7)';
                    }
                    else if(value.type == 1 && value.period == 2){
                        var type = 'Fixed';
                        var period = 'Weekly';
                        var amount = value.amount;
                        var amount_text = ' ';
                    }
                    else if(value.type == 1 && value.period == 3){
                        var type = 'Fixed';
                        var period = 'Monthly';
                        var amount = parseInt(value.amount/4);
                        var amount_text = '(Divided By 4)';
                    }
                    else{
                        var type = 'Variable';
                        var period = 'Monthly';
                        var amount = value.amount;
                        var amount_text = ' ';
                    }

                    $('#inc_exp_table').append($('<tr>')).append($('<td>').text(++i)).append($('<td>').text(type)).append($('<td>').text(period)).append($('<td>').text(value.date)).append($('<td>').text(value.title)).append($('<td>').text(value.description)).append($('<td>').text(amount+' '+amount_text));

                });
                }
                else{
                    $.each(data.income_lists,function(i,value){
                    // if(type == 1){
                    if(value.type == 1 && value.period == 1){
                        var type = 'Fixed';
                        var period = 'Daily';
                        var amount = value.amount * 30;
                        var amount_text = '(Mutiplied By 30)';
                    }
                    else if(value.type == 1 && value.period == 2){
                        var type = 'Fixed';
                        var period = 'Weekly';
                        var amount = value.amount * 4;
                        var amount_text = '(Mutiplied By 4)';
                    }
                    else if(value.type == 1 && value.period == 3){
                        var type = 'Fixed';
                        var period = 'Monthly';
                        var amount = value.amount;
                        var amount_text = ' ';
                    }
                    else{
                        var type = 'Variable';
                        var period = 'Monthly';
                        var amount = value.amount;
                        var amount_text = ' ';
                    }

                    $('#inc_exp_table').append($('<tr>')).append($('<td>').text(++i)).append($('<td>').text(type)).append($('<td>').text(period)).append($('<td>').text(value.date)).append($('<td>').text(value.title)).append($('<td>').text(value.description)).append($('<td>').text(amount+' '+amount_text));

                });
                }

            }
        });
}

function other_expense(){
    // alert('income');
        $('#hide_date').hide();

        $('#total_sales').empty();

        $('#sale_table').empty();

        $('#inc_exp_table').empty();

        if($('.nav-tabs .active').text() == 'Weekly'){
        // alert('nav2');
        var type = 2;
        var  daily = $('#weekly').val();
        }
        else if($('.nav-tabs .active').text() == 'Monthly'){
        // alert('nav3');
        var type = 3;
        var  daily = $('#monthly').val();
        }
        else{
            var type = 1;
            var  daily = $('#daily').val();
        }
        $.ajax({
           type:'POST',
           url:'/getTotalIncome',
           data:{
            "value": daily,
            "type": type,
            "_token":"{{csrf_token()}}"
           },

           	success:function(data){
                // alert('hello');
                $('#report').hide();
                $('#inc_exp').show();
                // alert(data.time);
                if(data.time == 1){
                $.each(data.expense_lists,function(i,value){
                    // if(type == 1){
                        if(value.type == 1 && value.period == 1){
                        var type = 'Fixed';
                        var period = 'Daily';
                        var amount = value.amount;
                        var amount_text = ' ';
                    }
                    else if(value.type == 1 && value.period == 2){
                        var type = 'Fixed';
                        var period = 'Weekly';
                        var amount = parseInt(value.amount/7);
                        var amount_text = '(Divided By 7)';
                    }
                    else if(value.type == 1 && value.period == 3){
                        var type = 'Fixed';
                        var period = 'Monthly';
                        var amount = parseInt(value.amount/30);
                        var amount_text = '(Divided By 30)';
                    }
                    else{
                        var type = 'Variable';
                        var period = 'Monthly';
                        var amount = value.amount;
                        var amount_text = ' ';
                    }

                    $('#inc_exp_table').append($('<tr>')).append($('<td>').text(++i)).append($('<td>').text(type)).append($('<td>').text(period)).append($('<td>').text(value.date)).append($('<td>').text(value.title)).append($('<td>').text(value.description)).append($('<td>').text(amount+' '+amount_text));

                });
                }
                else if(data.time == 2){
                    $.each(data.expense_lists,function(i,value){
                    // alert('hello');
                    if(value.type == 1 && value.period == 1){
                        var type = 'Fixed';
                        var period = 'Daily';
                        var amount = value.amount * 7;
                        var amount_text = '(Mutiplied By 7)';
                    }
                    else if(value.type == 1 && value.period == 2){
                        var type = 'Fixed';
                        var period = 'Weekly';
                        var amount = value.amount;
                        var amount_text = ' ';
                    }
                    else if(value.type == 1 && value.period == 3){
                        var type = 'Fixed';
                        var period = 'Monthly';
                        var amount = parseInt(value.amount/4);
                        var amount_text = '(Divided By 4)';
                    }
                    else{
                        var type = 'Variable';
                        var period = 'Monthly';
                        var amount = value.amount;
                        var amount_text = ' ';
                    }

                    $('#inc_exp_table').append($('<tr>')).append($('<td>').text(++i)).append($('<td>').text(type)).append($('<td>').text(period)).append($('<td>').text(value.date)).append($('<td>').text(value.title)).append($('<td>').text(value.description)).append($('<td>').text(amount+' '+amount_text));

                });
                }
                else{
                    $.each(data.expense_lists,function(i,value){
                    // if(type == 1){
                        if(value.type == 1 && value.period == 1){
                        var type = 'Fixed';
                        var period = 'Daily';
                        var amount = value.amount * 30;
                        var amount_text = '(Mutiplied By 30)';
                    }
                    else if(value.type == 1 && value.period == 2){
                        var type = 'Fixed';
                        var period = 'Weekly';
                        var amount = value.amount * 4;
                        var amount_text = '(Mutiplied By 4)';
                    }
                    else if(value.type == 1 && value.period == 3){
                        var type = 'Fixed';
                        var period = 'Monthly';
                        var amount = value.amount;
                        var amount_text = ' ';
                    }
                    else{
                        var type = 'Variable';
                        var period = 'Monthly';
                        var amount = value.amount;
                        var amount_text = ' ';
                    }

                    $('#inc_exp_table').append($('<tr>')).append($('<td>').text(++i)).append($('<td>').text(type)).append($('<td>').text(period)).append($('<td>').text(value.date)).append($('<td>').text(value.title)).append($('<td>').text(value.description)).append($('<td>').text(amount+' '+amount_text));

                });
                }

            }
        });
}

</script>

@endsection
