@extends('admin.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
                <h6 class="text-warning">لطفا همه مقادیر ستاره دار را تکمیل نمائید.</h6>
                @if(!empty($data->thump))
                <a href="{{asset($data->thump)}}">نمایش عکس بندانگشتی</a>
                @endif
                @if(!empty($data->icon))
                    || <a href="{{asset($data->icon)}}">نمایش عکس ایکون</a>
                @endif

                {!! form_start($form)!!}

                {!! form_until($form, 'status_id');!!}
                <div class="col-12 col-md-12 mb-1">
                    <label for="tags-input" class="form-label">برچسب ها</label>
                    @php
                        $tags = !empty(old('tags')) ? old('tags') : null;
                        if(!empty(@$data) && empty($tags)){
                            foreach(@$data->tags as $item){
                                $tags = $tags . $item->title . ',';
                            }
                        }
                    @endphp
                    <input type="text" class="form-control" name="tags" id="tags-input" value="{{$tags}}">
                </div>

                {!! form_end($form, true);!!}
            </div>
        </div>
    </div>

@stop

@section('script')
    <script>
        $('#language_id').on('change', function () {
            let id = $('#language_id').val();
            let url = "{{route('category.index')}}" + '?content_type=json&search=language_id:' + id + '&search=category_type_id:3'
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
            .create(document.querySelector('#content'), {
                language: 'fa',

            })
            .then(editor => {
                window.editor = editor;
                editor.ui.view.editable.element.style.height = '200px';

            })
            .catch(err => {
                console.error(err.stack);
            });


        $(document).ready(function () {
            let category = {{!empty($data->category) ? @$data->category->category_id :'null'}};
            let select = null;
            let id = $('#language_id').val();
            let url = "{{route('category.index')}}" + '?content_type=json&search=language_id:' + id +
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
