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
    {!! Form::checkbox('tag_ids[]', $tag->id, Route::currentRouteName() == 'post.edit' ? in_array($tag->id, $selected_tags) : false) !!} <span>{{ $tag->name }}</span>
  </div>
@endforeach
</div>

{!! Form::label('photo', 'Select Photo', ['class' => 'mt-2']) !!}
{!! Form::file('photo', ['class'=> 'form-control']) !!}

@if (Route::currentRouteName() == 'post.edit')
<div class="my-3">
    <img class="img-thumbnail post-image" data-src="{{ url('image/post/Original/'.$post->photo) }}" src="{{ url('image/post/Thumbnail/'.$post->photo) }}" alt="{{ $post->title }}">
</div>
@endif





@push('css')
{{-- <style>
    .ck.ck-editor__main>.ck-editor__editable{
        min-height: 200px;
        border-color: var(--ck-color-base-border);
    }
</style> --}}

@endpush

@push('js')
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script> --}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>

</script>

<script>

const get_sub_categories = (category_id) => {
    let route_name = '{{ Route::currentRouteName() }}'
       let sub_categories
       let sub_category_element = $('#sub_category_id');
       sub_category_element.empty();
       let sub_category_select = ''
       if (route_name == 'post.edit') {
        sub_category_select = 'selected';
       }
       sub_category_element.append(`<option ${sub_category_select}> Select Sub Category </option>`);
       axios.get(window.location.origin+'/dashboard/get-subcategory/'+ category_id).then(res=>{
        sub_categories = res.data
        sub_categories.map((sub_category, index)=>{
            let selected = ''
            if (route_name == 'post.edit') {
                let sub_category_id = '{{ $post->sub_category_id ?? null}}'
                if (sub_category.id == sub_category.id ) {
                  selected = 'selected'
            }
            }

           return  sub_category_element.append(`<option ${selected} value = "${sub_category.id}"> ${sub_category.name} </option>`)
        })
       })
    }



    // ClassicEditor
    //     .create( document.querySelector( '#discription' ) )
    //     .then( editor => {
    //             console.log( editor );
    //     } )
    //     .catch( error => {
    //             console.error( error );
    //     } );

    tinymce.init({
    selector: '#discription', // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: 'code table lists',
    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
  });

    $('#category_id').on('change', function() {
        let category_id = $('#category_id').val();
        get_sub_categories(category_id)
    })



    $('#title').on('input', function() {
        let name = $(this).val()
        let slug = name.replaceAll(' ', '-')
        $('#slug').val(slug.toLowerCase());
    })
</script>


@if(Route::currentRouteName() == 'post.edit')
    <script>
         get_sub_categories('{{ $post->category_id }}')
    </script>
@endif

@endpush
