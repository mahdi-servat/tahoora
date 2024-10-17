@extends('admin.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
                {!! form_start($form)!!}
                <div class="row">
                    {!! form_until($form, 'key');!!}
                    <div class="col-12 col-md-4 mb-1">
                        <label for="key" class="form-label">وضعیت</label>
                        <select name="active" id="active" class="form-control">
                            <option value="">انتخاب کنید</option>
                            <option value="1" {{!empty($data) && @$data->active == 1 ? 'selected' : null}}> فعال</option>
                            <option value="0" {{!empty($data) && @$data->active == 0 ? 'selected' : null}}> غیر فعال</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 mb-1">
                        <label for="rtl" class="form-label">چیدمان</label>
                        <select name="rtl" id="rtl" class="form-control">
                            <option value="">انتخاب کنید</option>
                            <option value="1" {{!empty($data) && @$data->rtl == 1 ? 'selected' : null}}> راست چین</option>
                            <option value="0" {{!empty($data) && @$data->rtl == 0 ? 'selected' : null}}> چپ چین</option>
                        </select>
                    </div>
                </div>

                {!! form_end($form, true);!!}
            </div>
        </div>
    </div>


@stop
