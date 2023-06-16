@extends('Backend.layout.master')
@section('page_title', 'Tag')
@section('page_sub_title', 'List')
@section('contant')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    <div class="col-6">
                        <h4>Tag List</h4>
                    </div>
                    <div class="col-6 text-end"> <a href="{{ route('tag.create') }}" class="btn btn-success btn-sm ">Add
                            Tag</a></div>
                </div>
                <div class="card-body">
                    @if (Session('msg'))
                        <div class=" alert alert-{{ session('cls') }}">
                            {!! session('msg') !!}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Order By</th>
                                <th>Created At</th>
                                <th>Uploadted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php  $sl = 1  @endphp
                            @foreach ($categories as $tag)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $tag->name }}</td>
                                    <td>{{ $tag->slug }}</td>
                                    <td>{{ $tag->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ $tag->order_by }}</td>
                                    <td>{{ $tag->created_at->toDayDateTimeString() }}</td>
                                    <td>{{ $tag->created_at != $tag->updated_at ? $tag->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('tag.show', $tag->id) }}"><button
                                                    class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button></a>
                                            <a href="{{ route('tag.edit', $tag->id) }}"><button
                                                    class="btn btn-warning btn-sm mx-1"><i
                                                        class="fa-solid fa-edit"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'delete',
                                                'id' => 'form_' . $tag->id,
                                                'route' => ['tag.destroy', $tag->id],
                                            ]) !!}
                                            {!! Form::button('<i class="fa-solid fa-trash"></i>', [
                                                'type' => 'button',
                                                'data-id' => $tag->id,
                                                'class' => ' delete btn btn-danger btn-sm',
                                            ]) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
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
