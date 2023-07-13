@extends('frontend.layout.master')
@section('Page_title', 'Contact Us')
@section('banner')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Feel Free To Contact Us</h4>
                            <h2>Contact Us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>Contact Us</h4>
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
            {!! Form::open(['method'=>'post','route'=>'contact.store']) !!}
            {!! Form::text('name', null, ['class'=>'form-control mt-3', 'placeholder'=>'Write Your Name']) !!}
            {!! Form::email('email', null, ['class'=>'form-control mt-3', 'placeholder'=>'Write Your Email']) !!}
            {!! Form::text('phone', null, ['class'=>'form-control mt-3', 'placeholder'=>'Write Your Phone Number']) !!}
            {!! Form::text('subject', null, ['class'=>'form-control mt-3', 'placeholder'=>'Write Your Subject']) !!}
            {!! Form::textarea('massage', null, ['class'=>'form-control mt-3', 'placeholder'=>'Write Your Massage','rows'=>'5']) !!}
            {!! Form::button('Send Massage',['class'=>'btn btn-success mt-3','type'=>'submit']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@if (Session('msg'))
    <div class=" alert alert-{{ session('cls') }}">
        {!! session('msg') !!}
    </div>
@endif
@endsection
@if(session('msg'))
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
@endif
