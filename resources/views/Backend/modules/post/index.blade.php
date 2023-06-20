@extends('Backend.layout.master')
@section('page_title', 'Post')
@section('page_sub_title', 'List')
@section('contant')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    <div class="col-6">
                        <h4>Post List</h4>
                    </div>
                    <div class="col-6 text-end"> <a href="{{ route('post.create') }}" class="btn btn-success btn-sm ">Add
                        Post</a></div>
                </div>
                <div class="card-body">
                    @if (Session('msg'))
                        <div class=" alert alert-{{ session('cls') }}">
                            {!! session('msg') !!}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover post-table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>
                                    <p>Title</p>
                                <hr>
                                    <p>Slug</p>
                                </th>
                                <th>
                                    <p>Category</p>
                                <hr>
                                    <p>Sub_Category</p>
                                </th>
                                <th>
                                    <p>Status</p>
                                    <hr>
                                    <p>Is_Approved</p>
                                </th>
                                <th><p>Photos</p></th>
                                <th><p>Tags</p></th>
                                <th>
                                    <p>Created At</p>
                                    <hr>
                                    <p>Uploadted At</p>
                                    <hr>
                                    <p>Created By</p>
                                </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php  $sl = 1  @endphp
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>
                                       <p>{{ $post->title }}</p>
                                        <hr>
                                       <p>{{ $post->slug }}</p>
                                    </td>
                                    <td>
                                       <p><a href="{{ route('category.show', $post->category_id) }}">{{ $post->category?->name }}</a></p>
                                        <hr>
                                       <p><a href="{{ route('sub_category.show', $post->sub_category_id) }}">{{ $post->sub_category?->name }}</a></p>
                                    </td>
                                    <td>
                                       <p>{{ $post->status ==1 ? 'Published' : 'Not Published' }}</p>
                                        <hr>
                                       <p>{{ $post->is_approved == 1 ? 'Approved' : 'Not Apporved' }}</p>
                                    </td>
                                    <td>
                                        <img class="img-thumbnail post-image" data-src="{{ url('image/post/Original/'.$post->photo) }}" src="{{ url('image/post/Thumbnail/'.$post->photo) }}" alt="{{ $post->title }}">
                                    </td>
                                    <td>
                                        @php
                                            $colors = ['btn-danger', 'btn-info', 'btn-dark', 'btn-success', 'btn-warning']
                                        @endphp
                                        @foreach ($post->tag as $tag)
                                        <a href="{{ route('tag.show', $tag->id) }}"><button class="btn -btn-sm mb-3 {{ $colors[random_int(0,4)] }}">{{ $tag->name }}</button></a>
                                        @endforeach
                                     </td>
                                    <td>
                                        <p>{{ $post->created_at->toDayDateTimeString() }}</p>
                                        <hr>
                                        <p>{{ $post->created_at != $post->updated_at ? $post->updated_at->toDayDateTimeString() : 'Not Updated' }}</p>
                                        <hr>
                                        <p>{{ $post->user->name }}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('post.show', $post->id) }}"><button
                                                    class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button></a>
                                            <a href="{{ route('post.edit', $post->id) }}"><button
                                                    class="btn btn-warning btn-sm mx-1"><i
                                                        class="fa-solid fa-edit"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'delete',
                                                'id' => 'form_' . $post->id,
                                                'route' => ['post.destroy', $post->id],
                                            ]) !!}
                                            {!! Form::button('<i class="fa-solid fa-trash"></i>', [
                                                'type' => 'button',
                                                'data-id' => $post->id,
                                                'class' => ' delete btn btn-danger btn-sm',
                                            ]) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
<!-- Button trigger modal -->
  <button id="image_show_button" type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#image_show">

  </button>
    <!-- Modal -->
<div class="modal fade" id="image_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Blog Image</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img class="img-thumbnail"  alt="Display Image" id="display_image">
        </div>
      </div>
    </div>
  </div>

    @push('js')
        <script>

            $('.post-image').on('click', function(){
                let img =  $(this).attr('data-src')
                $('#display_image').attr('src', img)
                $('#image_show_button').trigger('click')
            })

            $('.delete').on('click', function() {
                let id = $(this).attr('data-id')
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#form_${id}`).submit()
                    }
                })
            })
        </script>
    @endpush

@endsection
