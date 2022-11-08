<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Category::get(['name','id']);
        $brands = Brand::get(['name','id']);
        $products = Product::orderBy('id','DESC')->with(['category','brand'])->get()->all();
       // dd($products);
        return view('Product.product',compact('cats','brands','products'));
    }
    public function createProduct(){
        $cats = Category::get(['name','id'])->all();
        $brands = Brand::get(['name','id'])->all();
        return view('Product.productCreate',compact('cats','brands',));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::with(['category','brand'])->get()->all();
        //dd($product);
        return response()->json($product);
       // return view('')
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:products,real_name',
            'new_cat_name'=>'unique:categories,name',
            'new_brand_name'=>'unique:brands,name',
            'image'=>'image',
            'bar_code'=>'nullable|sometimes|unique:products,bar_code'
        ]);
       if(isset($request->new_cat_name)){
        $cat= new Category();
        $cat->name = $request->new_cat_name;
        $cat->save();
       }
       if(isset($request->new_brand_name)){
        $brand= new Brand();
        $brand->name = $request->new_brand_name;
        $brand->save();
       }
        $product = new Product();
        $product->name=$request->name . ' (' . $request->bar_code .')';
        $product->real_name=$request->name;
        $product->bar_code=$request->bar_code;
        $product->description=$request->description;
        if(isset($request->new_cat_name)){
            $product->cat_id=number_format(Category::orderBy('id','DESC')->get('id')->first()->id);
        }else{
            $product->cat_id=$request->cat_id;
        }
        if(isset($request->new_brand_name)){
            $product->brand_id=number_format(Brand::orderBy('id','DESC')->get('id')->first()->id);
        }else{
            $product->brand_id=$request->brand_id;
        }

        if($request->hasFile('image')){
            $file=$request->file('image');
            $extention=$file->getClientOriginalExtension();
            $fileName=time().'.'.$extention;
            $file->move('images',$fileName);
            $product->image=$fileName;
        }
        $product->save();
        return redirect()->back()->with('message','New Product Added Successfully');
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('inventory','category','brand','sold')->find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|unique:products,name,'.$id,
            'new_cat_name'=>'unique:categories,name',
            'new_brand_name'=>'unique:brands,name',
            'image'=>'image',
            'bar_code'=>'required|unique:products,bar_code,'.$id
        ]);
       // $product = new Product();
        $product = Product::find($id);
        $product->name=$request->name . ' (' . $request->bar_code .')';
        $product->real_name=$request->name;
        $product->bar_code=$request->bar_code;
        $product->description=$request->description;
        if(isset($request->new_cat_name)){
            $cat= new Category();
            $cat->name = $request->new_cat_name;
            $cat->save();
           }
           if(isset($request->new_brand_name)){
            $brand= new Brand();
            $brand->name = $request->new_brand_name;
            $brand->save();
           }
       // $product->qty=$request->qty;
       $product->bar_code=$request->bar_code;
       if(isset($request->new_cat_name)){
            $product->cat_id=number_format(Category::orderBy('id','DESC')->get('id')->first()->id);
        }else{
             $product->cat_id=$request->cat_id;
        }
        if(isset($request->new_brand_name)){
            $product->brand_id=number_format(Brand::orderBy('id','DESC')->get('id')->first()->id);
        }else{
            $product->brand_id=$request->brand_id;
        }


        if($request->hasFile('image')){
            $file=$request->file('image');
            $extention=$file->getClientOriginalExtension();
            $fileName=time().'.'.$extention;
            $file->move('images',$fileName);
            $product->image=$fileName;
        }
        $product->save();
        //dd($product);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::with('inventory')->find($id);
        //dd();
        if($product->inventory !== null && $product->inventory->qty>0){
            return redirect()->back()->with('error',"You have ".$product->inventory->qty ." Product is in your Inventory ! so u can't Delete right Now! ");
        }else{
            $product->delete();
            return redirect()->back()->with('message','Product Delete Successfully!');
        }
    }
}
