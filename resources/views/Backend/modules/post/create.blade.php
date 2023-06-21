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

                    {!! Form::open(['method' => 'Post', 'route' => 'post.store', 'files'=>'true']) !!}
                    @include('Backend.modules.post.form')
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
                get_sub_categories()
            })

            const get_sub_categories = () => {
                let category_id = $('#category_id').val();
               let sub_categories
               let sub_category_element = $('#sub_category_id');
               sub_category_element.empty();
               sub_category_element.append('<option selected = "selected"> Select Sub Category </option>');
               axios.get(window.location.origin+'/dashboard/get-subcategory/'+ category_id).then(res=>{
                sub_categories = res.data
                sub_categories.map((sub_category, index)=>(
                    sub_category_element.append(`<option value = "${sub_category.id}"> ${sub_category.name} </option>`)
                    ))
               })
            }

            $('#title').on('input', function() {
                let name = $(this).val()
                let slug = name.replaceAll(' ', '-')
                $('#slug').val(slug.toLowerCase());
            })
        </script>
    @endpush

@endsection
