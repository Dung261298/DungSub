<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use Session;
use App\Http\Requests\SlideRequest;
use Carbon\Carbon;
use DB;
class SlideController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index(Request $request)
{
    if ($request->seachlink != null) {
        $slides = Slide::where('link','like','%'.$request->seachlink.'%')->where('isdelete',false)->get();
        return view('admin.slide.index',compact('slides'));
    }
    $slides = Slide::where('isdelete',false)->get();
    return view('admin.slide.index',compact('slides'));
}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    return view('admin.slide.create');
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(SlideRequest $request)
{
   $request->validated();

   if($request->hasFile('url_img')){
    $url_img=$request->url_img->getClientOriginalName();
    $request->url_img->move('images', $url_img);
    $slide = new Slide;
    $slide->link = $request->link;;
    $slide->display_order = $request->display_order;
    $slide->url_img = $url_img;
    $slide->updated_at = null;
    $slide->isdelete = false;
    $slide->isdisplay = false;
    $slide->save();
    if ($slide){
       return redirect('/admin/slide')->with('message','Create Newsuccessfully!');
   }else{
     return back()->with('err','Save error!');
 }
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
    $slide = Slide::findOrFail($id);
    return view('admin.slide.detail',compact('slide'));
    
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    $slide = Slide::findOrFail($id);
    return view('admin.slide.edit',compact('slide'));
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function update(SlideRequest $request, $id)
{
    $request->validated();
    $slide =Slide::findOrFail($id);
    if($slide){

        if($request->hasFile('url_img') != null){
            
            $url_img=$request->url_img->getClientOriginalName();
            $request->url_img->move('images', $url_img);
            $slide->link = $request->link;
            $slide->url_img = $url_img;
            $slide->display_order = $request->display_order;
            $slide->updated_at = Carbon::now()->toDateTimeString();
            $slide->isdelete = false;
            $slide->isdisplay = false;
            $slide->update();
            return redirect('admin/slide')->with('message','Edit successfully!');
        }else{
            $slide->link = $request->link;
            $slide->display_order = $request->display_order;
            $slide->updated_at = Carbon::now()->toDateTimeString();
            $slide->isdelete = false;
            $slide->isdisplay = false;
            $slide->update();
            return redirect('admin/slide')->with('message','Edit successfully!');
        }
    }else{
        return redirect('admin/slide
            ')->with('message','Edit err!');
    }    
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy(Request $request)
{
   $slides = Slide::findOrFail($request->id);
   if ($slides) {
    $slides->isdelete = true;
    $slides->update();
} 
return redirect("admin/slide")->with('message','Delete successfully!'); 
}
}