@extends('Backend.layout.master')
@section('page_title', 'Tag')
@section('page_sub_title', 'Update')
@section('contant')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Update Tag</h4>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::model($tag, ['method' => 'PUT', 'route' => ['tag.update', $tag->id]]) !!}
                    @include('Backend.modules.tag.form')
                    {!! Form::button('Update Tag', ['type' => 'submit', 'class' => 'btn btn-success mt-2']) !!}
                    {!! Form::close() !!}
                </div>
                <a href="{{ route('tag.index') }}" class="btn btn-danger text-light"> Back </a>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $('#name').on('input', function() {
                let name = $(this).val()
                let slug = name.replaceAll(' ', '-')
                $('#slug').val(slug.toLowerCase());
            })
        </script>
    @endpush

@endsection
