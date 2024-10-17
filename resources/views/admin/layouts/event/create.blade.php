@extends('admin.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
                <h6 class="text-warning">لطفا همه مقادیر ستاره دار را تکمیل نمائید.</h6>
                {!! form($form)!!}
            </div>
        </div>
    </div>
@stop



@section('script')
    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ), {
                language: 'fa',
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            } )
            .then( editor => {
                window.editor = editor;
                editor.ui.view.editable.element.style.height = '200px';

            } )
            .catch( err => {
                console.error( err.stack );
            } );
    </script>
@stop
