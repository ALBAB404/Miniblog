@extends('Backend.layout.master')
@section('page_title', 'Sub_Category')
@section('page_sub_title', 'Details')
@section('contant')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sub_Category Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>{{ $subCategory->id }}</th>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $subCategory->name }}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $subCategory->category->name }}</td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td>{{ $subCategory->slug }}</td>>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $subCategory->status == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>
                            <tr>
                                <th>Order By</th>
                                <td>{{ $subCategory->order_by }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $subCategory->created_at->toDayDateTimeString() }}</td>
                            </tr>
                            <tr>
                                <th>Uploadted At</th>
                                <td>{{ $subCategory->created_at != $subCategory->updated_at ? $subCategory->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('sub_category.index') }}" class="btn btn-info btn-sm text-light"> Back </a>
                </div>
            </div>
        </div>
    </div>
@endsection
