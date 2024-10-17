@extends('admin.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
                <h6 class="text-warning">لطفا همه مقادیر ستاره دار را تکمیل نمائید.</h6>
                {!! form_start($form)!!}

                {!! form_until($form, 'thump');!!}
                <input type="hidden" name="thumpUrl" id="thumpUrl" value="{{@$data->thump}}">
                <div class="col-12 mb-1">
                    <img class="rounded" id="avatar" src="{{!empty(@$data->thump) ? '/'.@$data->thump : '/uploads/Untitled.jpg'}}"
                         alt="avatar" style="max-width: 400px">
                </div>
                <div class="progress mb-1 w-100">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0"
                         aria-valuemin="0" aria-valuemax="100">0%
                    </div>
                </div>
                {!! form_until($form, 'category_id');!!}
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



                {!! form_until($form, 'content');!!}

                <div class="col-12 my-1">
                    <hr>

                    <h4 class="text-info mt-3">
                        پیوست ها
                    </h4>
                </div>

                <div class="col-12" id="attachment_row">

                    <input type="hidden" name="count_row" id="count_row" value="1">
                    <div class="row">
                        <div class="col-12 col-md-3 mb-1">
                            <label for="title" class="form-label">عنوان</label>
                            <input class="form-control" name="atch_title[]" type="text" id="atch_title">
                        </div>
                        <div class="col-12 col-md-3 mb-1">
                            <label for="atch_sort" class="form-label">اولویت</label>
                            <input class="form-control" name="atch_sort[]" type="number" id="atch_sort">
                        </div>
                        <div class="col-12 col-md-3 mb-1">
                            <label for="thump" class="form-label">تصویر</label>
                            <input class="form-control col-12 mb-1 " name="atch_image[]" type="file" id="atch_image">
                        </div>
                        <div class="col-12 col-md-3 mb-1">
                            <button onclick="addAv($(this))" type="button"
                                    class="btn btn-success btn-sm d-block mb-1 waves-effect waves-light"><i class="fa fa-plus"></i>
                            </button>
                            <button onclick="removeAv($(this))" type="button"
                                    class="btn btn-danger btn-sm d-block mb-2 waves-effect waves-light" id="mmwdali"><i
                                    class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>

                @if (!empty($data->modelAttachments) && count($data->modelAttachments) > 0)
                    <div class="col-12 my-1">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    رسانه های موجود
                                </h4>
                            </div>
                            @foreach($data->modelAttachments as $item)
                                <div class="col-md-2 ">
                                    <img src="/{{$item->attachment->path}}" alt="{{$item->attachment->title}}" style="width:100%;border-top-right-radius: 10px;border-top-left-radius: 10px">
                                    <div class="d-flex align-items-center justify-content-center" style="width:100%;cursor:pointer;
                    background-color:#c30606;height: 30px;color: #FFFFFF;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px" onclick="$(this).parent().remove()">
                                        حذف
                                    </div>
                                    <input type="hidden" name="attachment_model[]" value="{{$item->id}}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {!! form_end($form, true);!!}
            </div>
        </div>
    </div>



    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
         aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">بریدن عکس</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="image" src="#">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
                    <button type="button" class="btn btn-primary" id="crop">بریدن</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('script')
    <script>

        function addAv(el) {
            let count = $('#count_row').val();

            let html = "<div class=\"row\">\n" +
                "            <div class=\"col-12 col-md-3 mb-1\">\n" +
                "                <label for=\"title\" class=\"form-label\">عنوان</label>\n" +
                "                <input class=\"form-control\" name=\"atch_title[]\" type=\"text\" id=\"atch_title\">\n" +
                "            </div>\n" +
                "            <div class=\"col-12 col-md-3 mb-1\">\n" +
                "                <label for=\"atch_sort\" class=\"form-label\">اولویت</label>\n" +
                "                <input class=\"form-control\" name=\"atch_sort[]\" type=\"number\" id=\"atch_sort\">\n" +
                "            </div>\n" +
                "            <div class=\"col-12 col-md-3 mb-1\">\n" +
                "                <label for=\"thump\" class=\"form-label\">تصویر</label>\n" +
                "                <input class=\"form-control col-12 mb-1 \" name=\"atch_image[]\" type=\"file\" id=\"atch_image\">\n" +
                "            </div>\n" +
                "            <div class=\"col-12 col-md-3 mb-1\">\n" +
                "                <button onclick=\"addAv($(this))\" type=\"button\"\n" +
                "                        class=\"btn btn-success btn-sm d-block mb-1 waves-effect waves-light\"><i class=\"fa fa-plus\"></i>\n" +
                "                </button>\n" +
                "                <button onclick=\"removeAv($(this))\" type=\"button\"\n" +
                "                        class=\"btn btn-danger btn-sm d-block mb-2 waves-effect waves-light\" id=\"mmwdali\"><i\n" +
                "                        class=\"fa fa-minus\"></i></button>\n" +
                "            </div>\n" +
                "        </div>";

            $('#attachment_row').append(html);
            $('#count_row').val(parseInt(count) + 1)
        }

        function removeAv(el) {
            let count = $('#count_row').val();
            if (parseInt(count) > 1) {
                let del = el.parent().parent();
                del.remove();
                $('#count_row').val(parseInt(count) - 1)
            }
        }

        $('#language_id').on('change', function () {
            let id = $('#language_id').val();
            let url = "{{route('category.index')}}" + '?content_type=json&search=language_id:' + id+ '&search=category_type_id:1'
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
        // CKEDITOR.replace('description', {
        //     customConfig: '/theme/admin/app-assets/plugins/ckeditor/config.js',
        //     height: 100,
        // });
        // CKEDITOR.replace('content', {
        //     customConfig: '/theme/admin/app-assets/plugins/ckeditor/config.js',
        //     height: 200,
        // });

        $(document).ready(function () {
            var avatar = document.getElementById('avatar');
            var image = document.getElementById('image');
            var input = document.getElementById('thump');
            var token = document.getElementsByName("_token")[0].value;
            var $progress = $('.progress');
            var $progressBar = $('.progress-bar');
            var $alert = $('.alert');
            var $modal = $('#modal');
            var cropper;

            let category = {{!empty($data->category) ? @$data->category->category_id :'null'}} ;
            let select = null;
            let id = $('#language_id').val();
            let url = "{{route('category.index')}}" + '?content_type=json&search=language_id:' + id+ '&search=category_type_id:1'
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

            input.addEventListener('change', function (e) {
                var files = e.target.files;
                var done = function (url) {
                    input.value = '';
                    image.src = url;
                    $alert.hide();
                    $modal.modal('show');
                };
                var reader;
                var file;
                var url;

                if (files && files.length > 0) {
                    file = files[0];

                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function (e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            $modal.on('shown.bs.modal', function () {
                cropper = new Cropper(image/*, {
                    aspectRatio: 1,
                    viewMode: 3,
                }*/);
            }).on('hidden.bs.modal', function () {
                cropper.destroy();
                cropper = null;
            });

            document.getElementById('crop').addEventListener('click', function () {
                var initialAvatarURL;
                var canvas;

                $modal.modal('hide');

                if (cropper) {
                    canvas = cropper.getCroppedCanvas(/*{
                        width: 320,
                        height: 320,
                    }*/);
                    initialAvatarURL = avatar.src;
                    avatar.src = canvas.toDataURL();
                    $progress.show();
                    $alert.removeClass('alert-success alert-warning');
                    canvas.toBlob(function (blob) {
                        var formData = new FormData();

                        formData.append('thump', blob, 'avatar.jpg');
                        formData.append('_token', token);
                        $.ajax('{{route("news.uploadThump")}}', {
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,

                            xhr: function () {
                                var xhr = new XMLHttpRequest();

                                xhr.upload.onprogress = function (e) {
                                    var percent = '0';
                                    var percentage = '0%';

                                    if (e.lengthComputable) {
                                        percent = Math.round((e.loaded / e.total) * 100);
                                        percentage = percent + '%';
                                        $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                                    }
                                };

                                return xhr;
                            },

                            success: function (data) {
                                $alert.show().addClass('alert-success').text('Upload success');
                                $('#avatar').attr('src', '/' + data)
                                $('#thumpUrl').val(data)
                            },

                            error: function () {
                                avatar.src = initialAvatarURL;
                                $alert.show().addClass('alert-warning').text('Upload error');
                            },

                            complete: function () {
                                $progress.hide();
                            },
                        });
                    });
                }
            });
        })


    </script>
@stop
