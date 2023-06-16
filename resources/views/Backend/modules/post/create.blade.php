@extends('Backend.layout.master')
@section('page_title', 'Post')
@section('page_sub_title', 'Create')
@section('contant')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>Create Post</h4>
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

                    {!! Form::open(['method' => 'Post', 'route' => 'post.store']) !!}
                    {!! Form::label('title', 'Title', ['class' => 'my-2']) !!}
                    {!! Form::text('title', null, [
                        'id' => 'title',
                        'class' => 'form-control',
                        'placeholder' => 'Enter Post Title',
                    ]) !!}
                    {!! Form::label('slug', 'Slug', ['class' => 'my-2']) !!}
                    {!! Form::text('slug', null, [
                        'id' => 'slug',
                        'class' => 'form-control ',
                        'placeholder' => 'Enter Post Slug',
                    ]) !!}
                    {!! Form::label('status', 'Post Status', ['class' => 'my-2']) !!}
                    {!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
                        'class' => 'form-control ',
                        'placeholder' => 'Enter Post status',
                    ]) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('category_id', 'Select Category', ['class' => 'my-2']) !!}
                            {!! Form::select('category_id', $categories, null, [
                                'id' => 'category_id',
                                'class' => 'form-select ',
                                'placeholder' => 'Select Parent Category',
                            ]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('sub_category_id', 'Select Sub Category', ['class' => 'my-2']) !!}
                            {!! Form::select('sub_category_id', $sub_categories, null, [
                                'class' => 'form-select ',
                                'placeholder' => 'Select Parent Category',
                            ]) !!}
                        </div>
                    </div>
                    {!! Form::button('Create Post', ['type' => 'submit', 'class' => 'btn btn-success mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $('#category_id').on('change', function() {
                console.log(1 < 2 < 3);
            })
        </script>
    @endpush

@endsection
