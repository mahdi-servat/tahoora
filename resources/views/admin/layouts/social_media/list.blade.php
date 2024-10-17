
@extends('admin.layouts.admin')
@section('content')
    <style>
        .icon-box > i{
            font-size: 23px !important;
        }
        .icon-box > svg{
            max-height: 23px !important;
        }
    </style>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive text-nowrap ">
                            <table class="table ">
                                <thead class="table text-center">
                                <tr>
                                    <th>{{__('panel.table-count')}}</th>
                                    <th>{{__('panel.icon')}}</th>
                                    <th>{{__('panel.title')}}</th>
                                    <th>{{__('panel.key')}}</th>
                                    <th>{{__('panel.value')}}</th>
                                    <th>{{__('panel.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0 text-center">
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
                                            <td class="icon-box">
{{--                                                <i class="fa-brands fa-instagram h-100" ></i>--}}
                                                {!! @$item->icon !!}
                                            </td>
                                            <td>
                                                {{@$item->title}}
                                            </td>
                                            <td>
                                                {{@$item->key}}
                                            </td>
                                            <td>
                                                {{!empty(@$item->languageKey(request('key'))) ? $item->languageKey(request('key'))->pivot->value : @$item->default}}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('socialMedia.edit' , ['id' => $item->id , 'key' => request('key')])}}"
                                                        ><i class="ti ti-pencil me-1"></i> {{__('panel.edit')}}</a
                                                        >
{{--                                                        <a class="dropdown-item" href="{{route('menu.destroy' , ['id' => $item->id])}}"--}}
{{--                                                        ><i class="ti ti-trash me-1"></i> {{__('panel.delete')}}</a--}}
{{--                                                        >--}}
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

@stop

@section('script')
    <script>
        $(document).ready(function () {
            $(".select2").select2({dropdownAutoWidth: true});
        });

    </script>
@stop
