@extends('admin.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
{{--                <h6 class="text-warning">لطفا همه مقادیر ستاره دار را تکمیل نمائید.</h6>--}}
                <form class="form row" method="POST" action="{{route('socialMedia.update' , ['id' => $data->id , 'key' => request('key')])}}">
                    @csrf
                    <div class="col-12 col-md-3 mb-1">
                        <label for="value" class="form-label">
                            لینک
                            {{@$data->title}}
                            برای زبان
                            {{App\Models\Language\Language::where('key' , request('key'))->first()->title}}
                        </label>
                        <input class="form-control" name="value" type="text" value="{{!empty(@$data->languageKey(request('key'))) ? $data->languageKey(request('key'))->pivot->value : @$data->default}}" id="value">
                    </div>
                    <div class="col-12 mt-2">
                        <button class="btn btn-info btn-tall waves-effect waves-light" type="submit" name="send">ارسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@stop

@section('script')
    <script>

    </script>
@stop
