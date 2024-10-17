@extends('admin.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
                @if(!empty($data->thump))
                    <div>
                        <a href="{{$data->thump->path}}">  نمایش عکس بارگذازی شده  </a>
                        <h6 class="text-warning">لطفا همه مقادیر ستاره دار را تکمیل نمائید.</h6>
                    </div>
                @endif

                {!! form($form)!!}

            </div>
        </div>
    </div>
@stop

