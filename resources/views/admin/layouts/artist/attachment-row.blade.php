<div class="row">
    <div class="col-12 col-md-3 mb-1">
        <label for="atch_title_{{$count}}" class="form-label">عنوان</label>
        <input class="form-control" name="atch_title[]" type="text" id="atch_title_{{$count}}" value="{{@$data['atch_title'][@$key]}}">
    </div>
    <div class="col-12 col-md-3 mb-1">
        <label for="atch_sort_{{$count}}" class="form-label">اولویت</label>
        <input class="form-control" name="atch_sort[]" type="number" id="atch_sort_{{$count}}" value="{{@$data['atch_sort'][@$key]}}">
    </div>
    <div class="col-12 col-md-3 mb-1" id="file_div_{{$count}}" style="{{!empty(@$data['atch_file_url'][@$key]) ? 'display:none' : ''}}">
        <label for="thump" class="form-label">فایل</label>
        <input class="form-control col-12 mb-1 " name="atch_image[]" type="file" id="atch_image_{{$count}}" onchange="uploadFile({{$count}})" >
    </div>
    <div class="col-12 col-md-3 mb-1" id="preview_box_{{$count}}" style="{{!empty(@$data['atch_file_url'][@$key]) ? '':'display:none'}}">
        <input type="hidden" name="atch_file_id[]" id="atch_file_id_{{$count}}" value="{{@$data['atch_file_id'][@$key]}}">
        <input type="hidden" name="atch_file_url[]" id="atch_file_url_{{$count}}" value="{{@$data['atch_file_url'][@$key]}}">
        <p class="form-label">
            پیش نمایش :
        </p>
        <a href="{{!empty(@$data['atch_file_url'][@$key]) ? @$data['atch_file_url'][@$key] : '#'}}" class="text-primary" target="_blank" id="preview_a_{{$count}}">
            <div class="avatar">
                <img src="{{!empty(@$data['atch_file_url'][@$key]) ? @$data['atch_file_url'][@$key] : '#'}}" alt="thump" class="rounded-circle" id="preview_img_{{$count}}">
            </div>
        </a>
    </div>


    <div class="col-12 col-md-3 mb-1">
        <button onclick="addAv($(this))" type="button"
                class="btn btn-success btn-sm d-block mb-1 waves-effect waves-light"><i class="fa fa-plus"></i>
        </button>
        <button onclick="removeAv($(this))" type="button"
                class="btn btn-danger btn-sm d-block mb-2 waves-effect waves-light" id="mmwdali"><i
                class="fa fa-minus"></i></button>
    </div>
    <div class="col-12 mb-1">
        <div class="progress" id="progress_box_{{$count}}" style="display:none">
            <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progress_bar_{{$count}}"></div>
        </div>


        <div class="col-12" id="error_box_{{$count}}" style="display:none">
            <span class="text-danger" id="error_text_{{$count}}">

            </span>
        </div>

        <div class="col-12">
            <hr>
        </div>
    </div>
</div>
