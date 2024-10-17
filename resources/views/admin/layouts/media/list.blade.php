@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive text-nowrap ">
                            <table class="table container">
                                <thead class="table">
                                <tr>
                                    <th>{{__('panel.table-count')}}</th>
                                    <th>{{__('panel.thump')}}</th>
                                    <th>{{__('panel.title')}}</th>
                                    <th>{{__('panel.status')}}</th>
                                    <th>{{__('panel.language')}}</th>
                                    <th>{{__('panel.date')}}</th>
                                    <th>{{__('panel.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @if(count($data) > 0)
                                    @php
                                        $i = 1 + $data->currentPage() * $data->perPage() - $data->perPage();
                                    @endphp
                                    @foreach($data as  $key=>$item)

                                        <tr class='clickable-row' data-href='{{route('media.edit' , ['id' => $item->id])}}'>
                                                <td>
                                                <span class="fw-medium">
                                                    {{@$i}}
                                                </span>
                                                </td>
                                                <td>
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar">
                                                            <img src="/{{@$item->thump}}" alt="thump"
                                                                 class="rounded-circle">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{@$item->title}}
                                                </td>
                                                <td>
                                                    @if(@$item->status_id == 1)
                                                        <span
                                                            class="badge bg-label-success me-1">{{__('panel.active')}}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-label-danger me-1">{{__('panel.disactive')}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{@$item->language->title}}
                                                </td>
                                                <td>
                                                    {{\App\Util::toJalali(@$item->date)}}
                                                </td>
                                                <td>@if($key>=2)
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                    class="btn p-0 dropdown-toggle hide-arrow"
                                                                    data-bs-toggle="dropdown">
                                                                <i class="ti ti-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                   href="{{route('media.edit' , ['id' => $item->id])}}"
                                                                ><i class="ti ti-pencil me-1"></i> {{__('panel.edit')}}
                                                                </a
                                                                >
                                                                <a class="dropdown-item"
                                                                   href="{{route('media.destroy' , ['id' => $item->id])}}"
                                                                ><i class="ti ti-trash me-1"></i> {{__('panel.delete')}}
                                                                </a
                                                                >
                                                            </div>
                                                        </div>
                                                    @endif
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
    <script>

        $(document).ready(function() {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>

@stop
