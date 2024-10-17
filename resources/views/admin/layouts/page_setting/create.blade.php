@extends('admin.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
                    <h6 class="text-warning">لطفا همه مقادیر ستاره دار را تکمیل نمائید.</h6>
                    {!! form($form)!!}
                    @if (!empty(@$data) && @$data->page_setting_type_id == 2)
                        <div class="col-12 mt-5">
                            <img src="/{{@$data->default}}" alt="default" style="max-width:100%">
                        </div>
                    @endif
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $('#page_setting_type_id').on('change', function(e){
            console.log(e.target.value)
            if(e.target.value == 1){
                $('#default_component').show();
                $('#file_component').hide();
            }else{
                $('#file_component').show();
                $('#default_component').hide();
            }
        })
    </script>
@stop
