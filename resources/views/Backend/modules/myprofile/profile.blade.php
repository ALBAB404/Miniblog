@extends('Backend.layout.master')
@section('page_title', 'Profile')
@section('page_sub_title', 'Update')
@section('contant')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Update Profile</h4>
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

                    {!! Form::model($profile,['method' => 'POST', 'route' => 'myprofile.store']) !!}
                        {!! Form::label('phone', 'Phone', ['class'=>'w-100 my-2']) !!}
                        {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                        {!! Form::label('address', 'Address', ['class'=>'w-100 my-2']) !!}
                        {!! Form::text('address', null, ['class'=>'form-control']) !!}
                       <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('division_id', 'Select Division', ['class'=>'w-100 my-2']) !!}
                            {!! Form::select('division_id', $divisions, null,['id'=>'divishion_id','class'=>'form-select','placeholder'=>'Select Divishion']) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="district_id" class="my-2">Select District</label>
                            <select name="district_id" id="district_id" class="form-select" disabled>
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="thana_id" class="my-2">Select Thana</label>
                            <select name="thana_id" id="thana_id" class="form-select" disabled>
                                <option value="">Select Thana</option>
                            </select>
                        </div>
                       </div>

                       <label for="gender" class="my-2">Gender</label>
                       <div class="d-flex">
                        <div class="d-flex me-4 ">
                            {!! Form::radio('gender', 'Male', false, ['class'=>'me-1 form-check']) !!} Male
                        </div>
                        <div class="d-flex me-4 ">
                            {!! Form::radio('gender', 'Female', false, ['class'=>'me-1 form-check']) !!} Female</div>
                        <div class="d-flex me-4 ">
                            {!! Form::radio('gender', 'Other', false, ['class'=>'me-1 form-check']) !!} Other</div>
                       </div>

                    {!! Form::button('Update Profile', ['type' => 'submit', 'class' => 'btn btn-success mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Profile Photo</h3>
                </div>
                <div class="card-body">
                    <img src="{{ asset('image/user/'.$profile?->photo) }}" class="img-thumbnail" id="previous_image" style="{{ $profile?->photo != null ? 'display:block' : 'display:none' }}">
                    <label for="" class="my-2">Upload Profile Photo</label>
                    <form action="">
                        <input type="file" id="image_input" class="form-control">
                        <button class="d-none" id="reset" type="reset"></button>
                    </form>
                    <p class="text-danger" id="errorMassage"></p>
                    <button style="width: 100px" class="btn btn-success my-3" id="image_upload_button">Upload</button>
                    <img class="img-thumbnail" id="image_preview">

                </div>
            </div>
        </div>
    </div>

    @php
        if ($profile) {
            $profile_exists = 1;
        }else {
            $profile_exists = 0;
        }
    @endphp
@endsection

@push('js')

    <script>
        let photo
        $('#image_input').on('change', function(e){
           let file =  e.target.files[0]
           let reader = new FileReader()
           reader.onloadend = () => {
                photo = reader.result
                $('#image_preview').attr('src', photo)
           }
           reader.readAsDataURL(file)
        })

        let is_loading = false

        const handleLoading = () => {
            if (is_loading) {
                $('#image_upload_button').html(`<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>`);
            }else{
                $('#image_upload_button').html('Upload');
            }
        }

        $('#image_upload_button').on('click', function (){
            if (photo != undefined) {
                is_loading = true
                handleLoading()
                axios.post(`${window.location.origin}/dashboard/upload-photo/`,{photo: photo}).then((res)=>{
                    is_loading = false
                    handleLoading()
                    let response =  res.data
                    $('#reset').trigger('click')
                    $('#previous_image').attr('src', response.photo).show()
                    $('#image_preview').attr('src', '')
                })


            }else{
                is_loading = false
                handleLoading()
                $('#errorMassage').text('Please Upload Your Image Or Profile Photo')
            }
        })





            ////////////////////////////////////////////////////////

        const getDistrict = (divishion_id, selected = null) => {
            axios.get(`${window.location.origin}/get-district/${divishion_id}`).then(res =>{

                let districts = res.data
                let elements = $('#district_id')
                thana_elements = $('#thana_id').empty().append(`<option>Select Thana</option>`).attr('disabled', 'disabled')
                elements.removeAttr('disabled')
                elements.empty()
                districts.map((district, index)=>{
                    elements.append(`<option value="${district.id}" ${selected == district.id ? 'selected' : ''}>${district.name}</option>`)
                })
            })
        }

        $('#divishion_id').on('change', function(){
            getDistrict($(this).val())
        })

// ........................

        const getThana = (thana_id, selected = null) => {
            axios.get(`${window.location.origin}/get-thana/${thana_id}`).then(res =>{

                let thanas = res.data
                let elements = $('#thana_id')
                elements.removeAttr('disabled')
                elements.empty()
                thanas.map((thana, index)=>{
                    elements.append(`<option value="${thana.id}" ${selected == thana.id ? 'selected' : ''}>${thana.name}</option>`)
                })
            })
        }

        $('#district_id').on('change', function(){
            getThana($(this).val())
        })


        if ('{{ $profile_exists }}' == 1) {
            getDistrict('{{ $profile?->division_id }}', '{{ $profile?->district_id }}')
            getThana('{{ $profile?->district_id }}', '{{ $profile?->thana_id }}')
        }


    </script>
@endpush
