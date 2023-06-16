<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\tag;
use Illuminate\Http\Request;

class tagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Tag::orderBy('order_by')->get();
        return view('Backend.modules.tag.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.modules.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:3|max:255',
            'slug'=>'required|min:3|max:255|unique:tags',
            'order_by'=>'required|numeric',
            'status'=>'required',
        ]);

        $tag_data = $request->all();
        $tag_data['slug'] = Str::slug($request->input('slug', '-'));
        tag::create($tag_data);
        session()->flash('cls','success');
        session()->flash('msg','Tag Created Successfully');
        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(tag $tag)
    {
        return view('Backend.modules.tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tag $tag)
    {
        return view('Backend.modules.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tag $tag)
    {
        $this->validate($request,[
            'name'=>'required|min:3|max:255',
            'slug'=>'required|min:3|max:255|unique:tags,slug,'.$tag->id,
            'order_by'=>'required|numeric',
            'status'=>'required',
        ]);

        $tag_data = $request->all();
        $tag_data['slug'] = Str::slug($request->input('slug', '-'));
        $tag->update($tag_data);
        session()->flash('cls','info');
        session()->flash('msg','Tag Updated Successfully');
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tag $tag)
    {
        $tag->delete();
        session()->flash('cls','danger');
        session()->flash('msg','Tag Deleted Successfully');
        return redirect()->route('tag.index');
    }
}
