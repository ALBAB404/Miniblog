<?php

namespace App\Http\Controllers;

use App\Models\district;
use App\Models\division;
use App\Models\MyProfile;
use App\Models\thana;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisions =  division::pluck('name','id');
        $profile = MyProfile::where('user_id', Auth::id())->first();
        return view('Backend.modules.myprofile.profile', compact('divisions','profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required',
            'gender' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
        ]);

        $profile_data = $request->all();
        $profile_data['user_id'] = Auth::id();
        MyProfile::updateOrCreate(['user_id' => $profile_data['user_id']], $profile_data);


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(MyProfile $myProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MyProfile $myProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MyProfile $myProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyProfile $myProfile)
    {
        //
    }

    public function getDistrictByDivision($division_id)
    {
        $districts =  district::where('division_id', $division_id)->select('name','id')->get()->toArray();
        return response()->json($districts);
    }


    public function getDivisionByThana($thana_id)
    {
        $districts =  thana::where('district_id', $thana_id)->select('name','id')->get()->toArray();
        return response()->json($districts);
    }

    public function upload_photo(Request $request)
    {
        $photo =    $request->input('photo');
        $name = Str::slug(Auth::user()->name.Carbon::now());
        $height = 200;
        $width = 200;
        $path = 'image/user/';

        $profile = MyProfile::where('user_id',Auth::id())->first();
        if($profile?->photo){
            PhotoUploadController::imageUnlink($path, $profile->photo);
        }

        $image_name =  PhotoUploadController::imageUpload($name,$height,$width,$path,$photo);

        $profile_data['photo'] = $image_name;

        if($profile){
            $profile->update($profile_data);
            return response()->json([
                'msg' => 'Profile Photo Upload Successfully',
                'cls'=> 'success',
                'photo' =>  url($path.$profile->photo)
            ]);
        }

        return response()->json([
            'msg' => 'Please Upload Profile First',
            'cls'=> 'warning',
        ]);

    }

}