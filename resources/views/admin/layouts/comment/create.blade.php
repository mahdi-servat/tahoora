@extends('admin.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h5 class="d-inline">
                            زبان :
                        </h5>

                        <strong>
                            {{@$data->language->title}}
                        </strong>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h5 class="d-inline">
                            نام :
                        </h5>

                        <strong>
                            {{@$data->name}}
                        </strong>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h5 class="d-inline">
                            ایمیل :
                        </h5>

                        <strong>
                            {{@$data->email}}
                        </strong>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h5 class="d-inline">
                            عنوان :
                        </h5>

                        <strong>
                            {{@$data->title}}
                        </strong>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h5 class="d-inline">
                            تاریخ :
                        </h5>

                        <strong>
                            {{\App\Util::toJalali(@$data->date)}}
                        </strong>
                    </div>

                    <div class="col-md-4 mb-3">
                        <h5 class="d-inline">
                            مرتبط با :
                        </h5>

                        <strong>
                            {{@$data->getClassName()}}
                            (
                            {{@$data->model->title}}
                            )
                        </strong>
                    </div>

                    <div class="col-12 mb-4">
                        <h5>
                            متن :
                        </h5>

                        <p>
                            {{@$data->description}}
                        </p>
                    </div>



                    <div class="col-12">
                        <form action="{{route('comment.update' , ['id' => $data->id])}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-3 mb-1">

                                    <label for="status_id" class="form-label">
                                        وضعیت
                                    </label>

                                    <?php
                                    $commentStatus = \App\Models\Comment\CommentStatus::all();
                                    ?>
                                    <select name="status_id" id="status_id" class="form-control">
                                        @foreach($commentStatus as $item)
                                            <option value="{{$item->id}}" {{$item->id == $data->status_id ? 'selected' : null}} >
                                                {{$item->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-3 mb-1 d-flex align-items-end">
                                    <button class="btn btn-success" type="submit">
                                        تایید
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('script')

@stop
