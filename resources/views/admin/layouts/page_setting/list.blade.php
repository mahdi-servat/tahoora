@extends('admin.layouts.admin')
@section('content')
    <div class="card mb-2">
        <div class="card-body py-3">
            <div class="card-content">
                <div class="col-12 mb-2">
                    <form onsubmit="searchObject2(event,'admin/pageSetting',
            [
                {param: 'title' , value: $('#title').val()},
                {param: 'key' , value: $('#key').val()} ,
            ],
            [
                {param: 'title' , value: $('#title').val()},
                {param: 'key' , value: $('#key').val()} ,
            ]
            )" method="get"
                          class="row gy-2 gx-3 align-items-center form">
                        <div class="col-md-2">
                            <label for="title">
                                عنوان
                            </label>
                            <input autofocus placeholder="جستجو" type="text" name="title" id="title"
                                   class="form-control form-value" value="{{request('title')}}"
                                   style="margin-left: 20px">
                        </div>

                        <div class="col-md-2">
                            <label for="title">
                                کلید
                            </label>
                            <input autofocus placeholder="جستجو" type="text" name="key" id="key"
                                   class="form-control form-value" value="{{request('key')}}"
                                   style="margin-left: 20px">
                        </div>

                        <div class="col-md-2 px-0">
                            <button style="margin-right: 10px;margin-top: 19px" id="send_btn" type="submit"
                                    class="btn btn-outline-success">جستجو
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-hover-animation table-striped table-bordered text-center">
                            <thead>
                            <tr>
                                <th width="5%">ردیف</th>
                                <th width="15%">عنوان</th>
                                <th width="15%">key</th>
                                <th width="15%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($data) && (count($data) > 0))
                                @php
                                    $i = 1 + $data->currentPage() * $data->perPage() - $data->perPage();
                                @endphp
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{@$item->title}}</td>
                                        <td>{{@$item->key}}</td>
                                        <td>
                                            <a class="text-info"
                                               href="{{route('pageSetting.edit' , ['id' => $item->id])}}">
                                                ویرایش
                                            </a>
                                            /
                                            <a class="text-danger"
                                               onclick="deleteR('{{route('pageSetting.destroy',['id'=>$item->id])}}','آیا از حذف این مورد اطمینان دارید؟ با حدف این مورد تمامی رابطه های مربوط به آن حذف خواهد شد.');"
                                               href="javascript:void(0)">
                                                حذف
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            @else

                            @endif
                            </tbody>
                        </table>
                    </div>
                    @if($data->hasPages())
                        <div class="col-12 text-center mt-5" style="height:50px">
                            {{$data->render()}}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    {{--    {{$paginator->count()}}--}}

@stop

@section('script')
    <script>
        $(document).ready(function () {
            $(".select2").select2({dropdownAutoWidth: true});
        });

    </script>
@stop
