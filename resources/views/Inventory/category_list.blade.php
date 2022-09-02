@extends('master')

@section('title','Category List')

@section('place')

{{-- <div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">@lang('lang.branch')</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">@lang('lang.back_to_dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('lang.category') @lang('lang.list')</li>
    </ol>
</div> --}}

@endsection

@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">        
        <h4 class="font-weight-normal">@lang('lang.category') @lang('lang.list')</h4>
    </div>
</div>


<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive text-black">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('lang.category') @lang('lang.code')</th>
                                <th>@lang('lang.category') @lang('lang.name')</th>
                                <th class="text-center">@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody id="category_table">
                            <?php $i=1;?>
                            @foreach($category_lists as $category)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$category->category_code}}</td>
                                <td>{{$category->category_name}}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-outline-warning" data-toggle="modal" data-target="#edit_item{{$category->id}}"><i class="fas fa-edit"></i>
                                    </a>

                                    <a href="#" class="btn btn-outline-danger" onclick="ApproveLeave('{{$category->id}}')">
                                    <i class="fas fa-trash-alt"></i></a>
                                </td>
                                
                                <div class="modal fade" id="edit_item{{$category->id}}" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">@lang('lang.edit_category_form')</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>

                                    <div class="modal-body">
                                        <form class="form-material m-t-40" method="post" action="{{route('category_update', $category->id)}}">
                                            @csrf
                                            <div class="form-group">    
                                                <label class="font-weight-bold">@lang('lang.code')</label>
                                                <input type="number" name="category_code" class="form-control" value="{{$category->category_code}}"> 
                                            </div>
                                            <div class="form-group">    
                                                <label class="font-weight-bold">@lang('lang.name')</label>
                                                <input type="text" name="category_name" class="form-control" value="{{$category->category_name}}"> 
                                            </div>
                                            <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="@lang('lang.save')">
                                        </form>           
                                    </div>
                               
                              </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title">@lang('lang.create_category_form')</h3>
                <form class="form-material m-t-40" method="post" action="{{route('category_store')}}">
                    @csrf
                    <div class="form-group">    
                        <label class="font-weight-bold">@lang('lang.code')</label>
                        <input type="number" name="category_code" class="form-control @error('category_code') is-invalid @enderror" placeholder="@lang('lang.enter_category_code')" required>

                        @error('category_code')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>
                    <div class="form-group">    
                        <label class="font-weight-bold">@lang('lang.name')</label>
                        <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" placeholder="@lang('lang.enter_category_name')" required>

                        @error('category_name')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror 

                    </div>
                    <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="@lang('lang.save_category')">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>

    function ApproveLeave(value){

        var category_id = value;

        swal({
            title: "@lang('lang.confirm')",
            icon:'warning',
            buttons: ["@lang('lang.no')", "@lang('lang.yes')"]
        })

      .then((isConfirm)=>{
        
        if(isConfirm){

            $.ajax({
                type:'POST',
                url:'category/delete',
                dataType:'json',
                data:{ 
                  "_token": "{{ csrf_token() }}",
                  "category_id": category_id,
                },

                success: function(){
                      
                    swal({
                        title: "Success!",
                        text : "Successfully Deleted!",
                        icon : "success",
                    });

                    setTimeout(function(){window.location.reload()}, 1000);

                        
                },            
            });
        }
      });


    }





</script>
@endsection