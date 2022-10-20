<?php

namespace App\Http\Controllers\API;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        if($products->count() > 0) {
            return response()->json([
                'message' => 'All Products',
                'status' => 'Success',
                'data' => $products
            ], 201);
        }else {
            return response()->json([
                'message' => 'No Data Found',
                'status' => 'Success',
                'data' => []
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'required',
            'content_en' => 'required',
            'content_ar' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',

        ]);

        //Uploads the files(Api)
        $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/products'), $img_name);

           //Convert name to json(Api)
           $name = json_encode([
            'en' => $request->name_en ,
            'ar' => $request->name_ar ,
        ], JSON_UNESCAPED_UNICODE);

           //Convert name to json(Api)
           $content = json_encode([
            'en' => $request->content_en ,
            'ar' => $request->content_ar ,
        ], JSON_UNESCAPED_UNICODE);


        $slugcount = Product::where('slug', 'like', '%' .  Str::slug($request->name_en) . '%' )->count();

        $slug = Str::slug($request->name_en);

        if($slugcount){
        $slug = Str::slug($request->name_en) .'-'. $slugcount;
        }

        // dd($slugcount , $slug);

        //Store data to database(Api)
        $product = Product::create([
            'name' => $name,
            'slug' => $slug,
            'image' => $img_name,
            'content' => $content,
            'price' =>  $request->price,
            'sale_price' =>  $request->sale_price,
            'quantity' =>  $request->quantity,
            'category_id' =>  $request->category_id,

        ]);

        //Upload album to images table if exists(Api)

        if($request->has('album')) {
            foreach($request->album as $item){
                $img_name = rand() . time() . $item->getClientOriginalName();
                $item->move(public_path('uploads/products'), $img_name);
                Image::create([
                    'path' => $img_name,
                    'product_id' => $product->id,
                ]);
            }
        }

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return Product::find($id);
        $product = Product::find($id);
        if($product) {
            return response()->json([
                'message' => 'Found Data',
                'status' => 'Success',
                'data' => $product
            ], 200);
        }else {
            return response()->json([
                'message' => 'No Found Data',
                'status' => 'Success',
                'data' => []
            ], 404);
        }
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

        // return $request->all();
        // exit;
        // return $id;
          //Validate the data
        //   $request->validate([

        //     'name_en' => 'required',
        //     'name_ar' => 'required',
        //     'image' => 'nullable',
        //     'content_en' => 'required',
        //     'content_ar' => 'required',
        //     'price' => 'required',
        //     'quantity' => 'required',
        //     'category_id' => 'required',

        // ]);

        $product = Product::findOrFail($id);
        $data = $request->all();// i brought this here to not write another if statment
        //Uploads the files(Api)
        $img_name = $product->image;
        if($request->hasFile('image')){
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/products'), $img_name);
            $data['image'] = $img_name;// and this is new for change the name of image
        }

           //Convert name to json(Api)
        if($request->has('name_en')) {
            $name = json_encode([
             'en' => $request->name_en ,
             'ar' => $product->name_ar ,
         ], JSON_UNESCAPED_UNICODE);
        }
        if($request->has('name_ar')) {
            $name = json_encode([
             'en' => $product->name_en ,
             'ar' => $request->name_ar ,
         ], JSON_UNESCAPED_UNICODE);
        }

           //Convert content to json(Api)
           if($request->has('content_en')) {
                $content = json_encode([
                'en' => $request->content_en ,
                'ar' => $product->content_ar ,
            ], JSON_UNESCAPED_UNICODE);
        }
           if($request->has('content_ar')) {
                $content = json_encode([
                'en' => $product->content_en ,
                'ar' => $request->content_ar ,
            ], JSON_UNESCAPED_UNICODE);
        }



            if($request->has('name_en') || $request->has('name_ar')) {

                // this variable "data" put a value on it called name // why "name" .. coz the column has this name.
                $data['name'] = $name;

                // "message": "SQLSTATE[42S22]: Column not found: 1054 Unknown column 'name_en' in 'field list
                // this "message" founded when i send a request in PostMan Coz the under two lines was not written
                // The "request" when he log in update(create) , he ask from you to keep of the data you enter as the columns name in our database
                // this two lines specially ('name_en' & 'name_ar' are not in our database , the column is 'name' in data base)
                // so we should delete this two columns
                unset($data['name_en']);
                unset($data['name_ar']);
                // after the deletion the functions has just "name"
            }

            if($request->has('content_en') || $request->has('content_ar')) {
                $data['content'] = $content;
                unset($data['content_en']);
                unset($data['content_ar']);

            }





        // return $data;
        // exit;


        return $product->update($data);


        // //Store data to database(Api)
        // $product->update([
        //     'name' => $name,
        //     'image' => $img_name,
        //     'content' => $content,
        //     'price' =>  $request->price,
        //     'sale_price' =>  $request->sale_price,
        //     'quantity' =>  $request->quantity,
        //     'category_id' =>  $request->category_id,

        // ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return 'yes';
        return Product::destroy($id);
    }
}
