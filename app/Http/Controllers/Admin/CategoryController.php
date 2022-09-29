<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::with('parent')->orderByDesc('id')->paginate(5);

        // dd($categories);

        return view('admin.categories.index',compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::all();
        return view('admin.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        //Validate Data
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        //Upload File

        $img_name = rand() . time() . $request->file('image')->getClientOriginalName();

        $request->file('image')->move(public_path('uploads/categories') , $img_name);


        //Convert name to json
        $name = json_encode([
            'en' => $request->name_en ,
            'ar' => $request->name_ar ,
        ], JSON_UNESCAPED_UNICODE);


        //Insert to database

        category::create([

            // 'name' => $request->name_en . ' ' . $request->name_ar ,
            'name' => $name,
            'image' => $img_name ,
            'parent_id' => $request->parent_id
        ]);


        //Redirect
        return redirect()->route('admin.categories.create')->with('msg','Category created successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = category::all();
        $category = category::findOrFail($id);
        return view('admin.categories.edit',compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          //Validate Data
          $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            // 'image' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = category::findOrFail($id);
        //Upload File

        $img_name =$category->image;
        if($request->hasFile('image'))
        {

            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();

            $request->file('image')->move(public_path('uploads/categories') , $img_name);
        }

        //Convert name to json
        $name = json_encode([
            'en' => $request->name_en ,
            'ar' => $request->name_ar ,
        ], JSON_UNESCAPED_UNICODE);

        //Insert to database

       $category->update([
            'name' => $name ,
            // 'name' => $request->name_en . ' ' . $request->name_ar ,
            'image' => $img_name ,
            'parent_id' => $request->parent_id
        ]);


        //Redirect
        return redirect()->route('admin.categories.create')->with('msg','Category updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // category::destroy($id);
        $category = category::findOrFail($id);

        File::delete(public_path('uploads/categories/ ' . $category->image));
        // category::where('parent_id', $category->id)->update(['parent_id' => null]);
        $category->children()->update(['parent_id' => null]);

        $category->delete();

        return redirect()->route('admin.categories.index')->with('msg','Category deleted successfully')->with('type', 'danger');

        // return redirect()->route('admin.categories.index')->with('fail','Category deleted successfully')->with('type', 'danger');
    }
}
