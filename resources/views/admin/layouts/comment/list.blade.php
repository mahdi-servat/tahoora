@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive text-nowrap text-center">
                            <table class="table ">
                                <thead class="table">
                                <tr>
                                    <th>{{__('panel.table-count')}}</th>
                                    <th>{{__('panel.name')}}</th>
                                    <th>{{__('panel.title')}}</th>
                                    <th>{{__('panel.status')}}</th>
                                    <th>{{__('panel.language')}}</th>
                                    <th>{{__('panel.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @if(count($data) > 0)
                                    @php
                                        $i = 1 + $data->currentPage() * $data->perPage() - $data->perPage();
                                    @endphp
                                    @foreach($data as $item)
                                        <tr>
                                            <td>
                                                <span class="fw-medium">
                                                    {{@$i}}
                                                </span>
                                            </td>
                                            <td>
                                                {{@$item->name}}
                                            </td>
                                            <td>
                                                {{@$item->title}}
                                            </td>
                                            <td>
                                                @if(@$item->status_id == 2)
                                                    <span class="badge bg-label-success me-1">
                                                        تایید
                                                    </span>
                                                @elseif(@$item->status_id == 3)
                                                    <span class="badge bg-label-danger me-1">
                                                        عدم تایید
                                                    </span>
                                                @elseif(@$item->status_id == 1)
                                                    <span class="badge bg-label-light me-1 text-dark">
                                                        بررسی نشده
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                {{@$item->language->title}}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('comment.edit' , ['id' => $item->id])}}"
                                                        ><i class="ti ti-pencil me-1"></i> {{__('panel.edit')}}</a
                                                        >
                                                        <a class="dropdown-item" href="{{route('program.destroy' , ['id' => $item->id])}}"
                                                        ><i class="ti ti-trash me-1"></i> {{__('panel.delete')}}</a
                                                        >
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

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

@stop
