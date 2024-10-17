@extends('admin.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
                <h6 class="text-warning">لطفا همه مقادیر ستاره دار را تکمیل نمائید.</h6>
                {!! form_start($form)!!}


                {!! form_until($form, 'status_id');!!}



                {!! form_end($form, true);!!}
            </div>
        </div>
    </div>

@stop

@section('script')

@stop
