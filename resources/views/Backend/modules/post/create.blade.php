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
                                'class' => 'form-select',
                                'placeholder' => 'Select Parent Category',
                            ]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('sub_category_id', 'Select Sub Category', ['class' => 'my-2']) !!}
                            <select name="sub_category_id" class="form-select" id="sub_category_id">
                                <option selected = "selected"> Select Sub Category </option>
                            </select>
                        </div>
                    </div>
                    {!! Form::label('discription', 'Discription', ['class' => 'my-2']) !!}
                    {!! Form::textarea('discription', null, ['id'=>'discription','class' => 'form-control','placeholder' => 'Type Something Short Discription']) !!}

                    {!! Form::label('tag', 'Select Tag', ['class' => 'my-2']) !!}
                </br>
                <div class="row">
                    @foreach ($tags as $tag)
                      <div class="col-md-3">
                        {!! Form::checkbox('tag_id', $tag->id, false) !!} <span>{{ $tag->name }}</span>
                      </div>
                    @endforeach
                 </div>

                    {!! Form::label('photo', 'Select Photo', ['class' => 'mt-2']) !!}
                    {!! Form::file('photo', ['class'=> 'form-control']) !!}

                    {!! Form::button('Create Post', ['type' => 'submit', 'class' => 'btn btn-success mt-3']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            .ck.ck-editor__main>.ck-editor__editable{
                min-height: 200px;
                border-color: var(--ck-color-base-border);
            }
        </style>
    @endpush

    @push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
        <script>

            ClassicEditor
                .create( document.querySelector( '#discription' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );

            $('#category_id').on('change', function() {
               let category_id = $(this).val();
               let sub_categories
               let sub_category_element = $('#sub_category_id');
               sub_category_element.empty();
               sub_category_element.append('<option selected = "selected"> Select Sub Category </option>');
               axios.get(window.location.origin+'/dashboard/sub_category/'+ category_id).then(res=>{
                sub_categories = res.data
                sub_categories.map((sub_category, index)=>(
                    sub_category_element.append(`<option value = "${sub_category.id}"> ${sub_category.name} </option>`)
                    ))
               })
            })

            $('#title').on('input', function() {
                let name = $(this).val()
                let slug = name.replaceAll(' ', '-')
                $('#slug').val(slug.toLowerCase());
            })
        </script>
    @endpush

@endsection
