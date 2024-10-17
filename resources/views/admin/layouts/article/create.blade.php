@extends('admin.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
                <h6 class="text-warning">لطفا همه مقادیر ستاره دار را تکمیل نمائید.</h6>
                {!! form_start($form)!!}

{{--                {!! form_until($form, 'thump');!!}--}}
{{--                <input type="hidden" name="thumpUrl" id="thumpUrl" value="{{@$data->thump}}">--}}
{{--                <div class="col-12 mb-1">--}}
{{--                    <img class="rounded" id="avatar" src="{{!empty(@$data->thump) ? '/'.@$data->thump : '/uploads/Untitled.jpg'}}"--}}
{{--                         alt="avatar" style="max-width: 400px">--}}
{{--                </div>--}}
{{--                <div class="progress mb-1 w-100">--}}
{{--                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0"--}}
{{--                         aria-valuemin="0" aria-valuemax="100">0%--}}
{{--                    </div>--}}
{{--                </div>--}}
                {!! form_until($form, 'status_id');!!}
                <div class="col-12 col-md-10 mb-1">
                    <label for="tags-input" class="form-label">برچسب ها</label>
                    @php
                        $tags = !empty(old('tags')) ? old('tags') : null;
                        if(!empty(@$data) && empty($tags)){
                            foreach(@$data->tags as $item){
                                $tags = $tags . $item->title . ',';
                            }
                        }
                    @endphp
                    <input type="text" class="form-control" name="tags"  id="tags-input" value="{{$tags}}">
                </div>



{{--                {!! form_until($form, 'content');!!}--}}

                {!! form_end($form, true);!!}
            </div>
        </div>
    </div>

@stop

@section('script')
    <script>
        $('#language_id').on('change', function () {
            let id = $('#language_id').val();
            let url = "{{route('category.index')}}" + '?content_type=json&search=language_id:' + id+ '&search=category_type_id:2'
            $.get(url, function (data) {
                $('#category_id').empty().append('<option value="">انتخاب کنید</option>')
                data.map(function (item) {
                    $('#category_id').append('<option value="' + item.id + '">' + item.title + '</option>');
                });
                $('#category_id').prop('disabled', false)
            });
        })

        let tagInput = document.querySelector('#tags-input');
        let tagify = new Tagify(tagInput)

        ClassicEditor
            .create( document.querySelector( '#content' ), {
                language: 'fa',
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            } )
            .then( editor => {
                window.editor = editor;
                editor.ui.view.editable.element.style.height = '200px';

            } )
            .catch( err => {
                console.error( err.stack );
            } );


        $(document).ready(function () {
            let category = {{!empty($data->category) ? @$data->category->category_id :'null'}} ;
            let select = null;
            let id = $('#language_id').val();
            let url = "{{route('category.index')}}" + '?content_type=json&search=language_id:' + id+ '&search=category_type_id:2'
            $.get(url, function (data) {
                $('#category_id').empty().append('<option value="">انتخاب کنید</option>')
                data.map(function (item) {
                    if (item.id === category) {
                        select = 'selected'
                    } else {
                        select = null;
                    }
                    $('#category_id').append('<option value="' + item.id + '"' + select + '  >' + item.title + '</option>');
                });
                if (data.length > 0) {
                    $('#category_id').prop('disabled', false)
                }
            });

            $('[data-toggle="tooltip"]').tooltip();
        })


    </script>
@stop
