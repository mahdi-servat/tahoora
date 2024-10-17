@extends('admin.layouts.admin')

@section('content')
    <div class="card mb-2" style="width: fit-content">
        <div class="card-content">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">
                        مشخصات اصلی
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">
                        تصاویر
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {!! form_start($form)!!}

            <div class="card-content">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <div class="row">
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

                            {!! form_until($form, 'send');!!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="col-12" id="attachment_row">
                            @if(!empty(old('atch_file_id')) && count(old('atch_file_id')) > 0)
                                @php
                                    $count = 1 ;
                                @endphp
                                @foreach(old('atch_file_id') as $key => $val)
                                    @if(!empty($val) )
                                        {!! view('admin.layouts.media.attachment-row' , ['count' => $count , 'data' => old() , 'key' => $key]) !!}
                                        @php
                                            $count++;
                                        @endphp
                                    @endif
                                @endforeach
                            @else
                                {!! view('admin.layouts.media.attachment-row' , ['count' => 1]) !!}
                            @endif
                            <input type="hidden" name="count_row" id="count_row" value="1">

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
                                        <div class="col-md-2 mb-2">
                                            @if($item->attachment->attachment_type_id == 1)
                                                <img src="/{{$item->attachment->path}}"
                                                     title="{{$item->attachment->description}}"
                                                     style="width:100%;border-top-right-radius: 10px;border-top-left-radius: 10px">
                                                <div class="d-flex align-items-center justify-content-center" style="width:100%;cursor:pointer;
                    background-color:#c30606;height: 30px;color: #FFFFFF;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px"
                                                     onclick="$(this).parent().remove()">
                                                    حذف
                                                </div>
                                                <input type="hidden" name="attachment_model[]" value="{{$item->id}}">
                                            @else
                                                <video controls
                                                       style="width:100%;border-top-right-radius: 10px;border-top-left-radius: 10px">
                                                    <source src="/{{$item->attachment->path}}" type="video/mp4">
                                                </video>

                                                <div class="d-flex align-items-center justify-content-center" style="width:100%;cursor:pointer;
                    background-color:#c30606;height: 30px;color: #FFFFFF;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px"
                                                     onclick="$(this).parent().remove()">
                                                    حذف
                                                </div>
                                                <input type="hidden" name="attachment_model[]" value="{{$item->id}}">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('script')
    <script>
        function addAv(el) {
            let count = $('#count_row').val();
            let url = "{{route('media.getAttachmentRow')}}?count=" + count
            $.get(url, function (data) {
                $('#attachment_row').append(data);
            })
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

        let tagInput = document.querySelector('#tags-input');
        let tagify = new Tagify(tagInput)

        function uploadFile(i) {
            let file_id = '#atch_image_' + i;
            let progress_box_id = '#progress_box_' + i;
            let progress_bar_id = '#progress_bar_' + i;
            let preview_box_id = '#preview_box_' + i;
            let file_div_id = '#file_div_' + i;
            let preview_a_id = '#preview_a_' + i;
            let preview_img_id = '#preview_img_' + i;
            let atch_file_url_id = '#atch_file_url_' + i;
            let error_box_id = '#error_box_' + i;
            let error_text_id = '#error_text_' + i;
            let atch_file_id = '#atch_file_id_' + i;
            let file = $(file_id)[0];
            let form = new FormData();
            form.append('upload', file.files[0]);
            $(progress_box_id).show();

            $.ajax({
                url: '/admin/media/uploadFile',
                type: 'POST',
                data: form,
                processData: false,
                contentType: false,
                xhr: function () {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (event) {
                        if (event.lengthComputable) {
                            var percentComplete = event.loaded / event.total * 100;
                            $(progress_bar_id).width(percentComplete + '%');
                            $(progress_bar_id).html(percentComplete.toFixed(2) + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function (response) {
                    $(progress_box_id).hide();
                    let json = JSON.parse(response);
                    $(file_div_id).hide();
                    $(preview_box_id).show();
                    $(preview_a_id).attr('href', json.url);
                    $(preview_img_id).attr('src', json.url);
                    $(atch_file_id).attr('value', json.id)
                    $(atch_file_url_id).attr('value', json.url)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $(progress_box_id).hide();
                    $(error_box_id).show();
                    $(error_text_id).empty().text(errorThrown)
                    $(atch_file_id).attr('value', '')
                }
            });

        }

        $(document).ready(function () {
            $('#upload-form').submit(function (event) {
                event.preventDefault();

                // Get the file input element
                var fileInput = $('#file-input')[0];

                // Create a new FormData object
                var formData = new FormData();

                // Append the file to the FormData object
                formData.append('upload', fileInput.files[0]);

                // Show the progress bar
                $('.progress').show();

                // Send the file to the server using AJAX
                $.ajax({
                    url: '/admin/upload/ck',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function () {
                        // Create an XMLHttpRequest object
                        var xhr = new XMLHttpRequest();

                        // Set the upload progress callback function
                        xhr.upload.addEventListener('progress', function (event) {
                            if (event.lengthComputable) {
                                // Calculate the percentage of upload progress
                                var percentComplete = event.loaded / event.total * 100;

                                // Update the progress bar
                                $('.progress-bar').width(percentComplete + '%');
                                $('.progress-bar').html(percentComplete.toFixed(2) + '%');
                            }
                        }, false);

                        return xhr;
                    },
                    success: function (response) {
                        // Hide the progress bar
                        $('.progress').hide();
                        let json = JSON.parse(response);

                        // Show the upload result
                        let html = "<img src='" + json.url + "'>"
                        $('#upload-result').append(html);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // Hide the progress bar
                        $('.progress').hide();

                        // Show the error message
                        $('#upload-result').html('Error uploading file: ' + errorThrown);
                    }
                });
            });
        });
    </script>
@stop
