@extends('admin.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
{{--                <h6 class="text-warning">لطفا همه مقادیر ستاره دار را تکمیل نمائید.</h6>--}}
                {!! form($form)!!}
            </div>
        </div>
    </div>



@stop

@section('script')
    <script>
        $(document).ready(function () {
            @if(!empty($data) && !empty($data->language_id))
            let id = $('#language_id').val();
            let url = "{{route('menu.index')}}" + '?content_type=json&search=language_id:' + {{@$data->language_id}} ;
            let parent = {{!empty($data->parent_id) ? @$data->parent_id: 'null'}} ;
            let select = null;
            $.get(url, function (data) {
                $('#parent_id').empty().append('<option value="">انتخاب کنید</option>')
                data.map(function (item) {

                    if (item.id === parent) {
                        select = 'selected'
                    } else {
                        select = null;
                    }
                    $('#parent_id').append('<option value="' + item.id + '" '+ select +'>' + item.title + '</option>');
                });
                $('#parent_id').prop('disabled', false)
            });
            @endif

        })
        $('#language_id').on('change', function () {
            let id = $('#language_id').val();
            let url = "{{route('menu.index')}}" + '?content_type=json&search=language_id:' + id;
            console.log(url)
            $.get(url, function (data) {
                $('#parent_id').empty().append('<option value="">انتخاب کنید</option>')
                data.map(function (item) {
                    $('#parent_id').append('<option value="' + item.id + '">' + item.title + '</option>');
                });
                $('#parent_id').prop('disabled', false)
            });
        })
    </script>
@stop
