@extends('Backend.layout.master')
@section('page_title', 'Category')
@section('page_sub_title', 'Details')
@section('contant')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Category Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-sm">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>{{ $tag->id }}</th>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $tag->name }}</td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td>{{ $tag->slug }}</td>>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $tag->status == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>
                            <tr>
                                <th>Order By</th>
                                <td>{{ $tag->order_by }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $tag->created_at->toDayDateTimeString() }}</td>
                            </tr>
                            <tr>
                                <th>Uploadted At</th>
                                <td>{{ $tag->created_at != $tag->updated_at ? $tag->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('tag.index') }}" class="btn btn-info btn-sm text-light"> Back </a>
                </div>
            </div>
        </div>
    </div>
@endsection
