<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Session;
use Validator;
use Illuminate\Support\Str; 
use DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function getCategory()
    {
        return Category::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->seachname != null) {
        //tim ten vs hien thi cac hang co isdelete == false
            $products = Product::where('name','like','%'.$request->seachname.'%')->where('isdelete',false)->get();
            return view('admin.product.index',compact('products'));
        }
        $products = Product::orderBy('created_at', 'desc')->get();
        $categories = $this->getCategory();

        if($request->cate)
        {
            $products->where('category_id',$request->cate);
        }
        $products = Product::where('isdelete',false)->get(); 
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::where('isdelete',false)->pluck('name','id')->toArray();
        $category = Category::where('isdelete',false)->pluck('name','id')->toArray();
        return view('admin.product.create',compact('brand','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request->validated();
        if($request->hasFile('image'))
        {
            $image=$request->image->getClientOriginalName();
            $request->image->move('images', $image); 
        }
        $product = new  Product();
        $product->product_code = $request->product_code;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->slug = Str::slug($request->slug ? $request->slug : $request->name);
        $product->image = $image;
        $product->promotion = $request->promotion;
        $product->quantity = $request->quantity;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->isdelete = false;
        $product->isdisplay = false;
        $product->updated_at = null;
        $product->save();
        if ($product){
            return redirect('/admin/product')->with('message','Create successfully!');
        }else{
            return back()->with('err','Save error!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrfail($id);
        return view('admin.product.detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrfail($id);
        $brand = Brand::where('isdelete',false)->pluck('name','id')->toArray();
        $category = Category::where('isdelete',false)->pluck('name','id')->toArray();
        return view('admin.product.edit',compact('brand','category','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        if($product)
        {
            if ($request->hasFile('imagee') )
            {
                $imagename=$request->imagee->getClientOriginalName();
                $request->imagee->move('images', $imagename); 
            }else{
                $imagename = $request->image;
            }
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->slug = Str::slug($request->slug ? $request->slug : $request->name);
            $product->image = $imagename;
            $product->promotion = $request->promotion;
            $product->quantity = $request->quantity;
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->updated_at = Carbon::now()->toDateTimeString();
            $product->isdelete = false;
            $product->isdisplay = false;
            $product->updated_at = Carbon::now()->toDateTimeString() ;
            $product->update();
            return redirect('/admin/product')->with('message','Update successfully!');
        }
        return back()->with('err','Update err!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {  
       $product = Product::findOrFail($request->id);
       if ($product) {
        $product->isdelete = true;
        $product->update();
    } 
  return redirect("admin/product")->with('message','Delete successfully!'); 
}
  public function setvalue(Request $request)
  {
    if ($request->ajax()) {
        $value = class_basename($request->value);
        return Response($value);
    }
}
}