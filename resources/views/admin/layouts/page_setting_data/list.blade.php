
@extends('admin.layouts.admin')
@section('content')
    <div class="card mb-2" style="width: fit-content">
        <div class="card-content">
            <ul class="nav nav-pills" id="pills-tab" role="tablist" >
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                        عنوان ها
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        فایل ها
                    </button>
                </li>
            </ul>
        </div>
    </div>


    <div class="card">
        <div class="card-body">

            <div class="card-content">
                <form method="POST" action="{{route('pageSettingData.update' , ['key' => request('key')])}}" enctype="multipart/form-data">
                    @csrf
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        @if(!empty($titles) && count($titles) > 0)
                            @foreach($titles as $title)
                                <div class="col-12 col-md-4 mb-1">
                                    <label for="{{@$title->key}}" class="form-label">
                                        {{@$title->title}}
                                    </label>
                                    <input class="form-control" name="page_setting[{{@$title->id}}]"
                                           type="text" id="{{@$title->key}}"
                                           value="{{!empty(@$title->languageKey(request('key'))) ? @$title->languageKey(request('key'))->content : $title->default}}">
                                </div>
                            @endforeach

                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-success">
                                    ارسال
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        @if(!empty($attachments) && count($attachments) > 0)
                            @foreach($attachments as $attachment)
                                <div class="col-12 col-md-4 mb-1">
                                    <label for="{{@$attachment->key}}" class="form-label">
                                        {{@$attachment->title}}

                                        @if(!empty(@$attachment->languageKey(request('key'))))
                                            <a href="{{env('APP_URL') .'/' . @$attachment->languageKey(request('key'))->content}}" target="_blank">
                                                (فایل فعلی)
                                            </a>
                                        @else
                                            <a href="{{env('APP_URL') . '/' . @$attachment->default}}" target="_blank">
                                                (فایل فعلی)
                                            </a>
                                        @endif
                                    </label>
                                    <input class="form-control" name="page_setting[{{@$attachment->id}}]"
                                           type="file" id="{{@$attachment->key}}">
                                </div>
                            @endforeach
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-success">
                                        ارسال
                                    </button>
                                </div>
                        @endif
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>


@stop

@section('script')
    <script>
        $(document).ready(function () {
            $(".select2").select2({dropdownAutoWidth: true});
        });

    </script>
@stop
