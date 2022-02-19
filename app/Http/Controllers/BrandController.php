<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\MultiPic;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class BrandController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function allBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function store(Request $request){

        $validateBrand = $request->validate([
            'brand_name' => 'required|min:4|unique:brands',
            'brand_image' => 'required'
        ],
        [
            'brand_name.required' => 'Please input brand name',

        ]);


        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
         $brand_image->move($up_location,$img_name);

      // $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
       // $up_location = 'image/brand/';
      // Image::make( $brand_image)->resize(300,200)->save( 'image/brand/'.$name_gen);

       //$last_img = 'image/brand/'.$name_gen;



        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' =>$last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Picture uploaded successfully');

    }

    public function edit($id){
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id){
        $validateBrand = $request->validate([
            'brand_name' => 'required|min:4',
        ],
        [
            'brand_name.required' => 'Please input brand name',
        ]);
        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if($brand_image){

            $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);

        unlink($old_image);

        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' =>$last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand updated successfully');

        }else {

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                //'brand_image' =>$last_img,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->back()->with('success', 'Brand updated successfully');

        }
    }

    public function delete($id){
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        $brand = Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand deleted successfully');

    }

    //MultiImage
    public function multiPic(){
        $images = MultiPic::all();
        //return $images;
        return view('admin.multipic.index', compact('images'));
    }

    public function storeMulti(Request $request){

        $image = $request->file('image');
        foreach($image as $multi_img){
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($multi_img->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/multi/';
        $last_img = $up_location.$img_name;
        $multi_img->move($up_location,$img_name);

        MultiPic::insert([
            'image' =>$last_img,
        ]);
    }//end foreach
        return Redirect()->back()->with('success','Pictures added successfully');


            /*foreach($request->image as $image){
                $filename = $image->getClientOriginalName();
                //print_r($filename);
                //$filesize = $file->getClientSize();
                $image->storeAs('image/multi/', $filename);
                $image = new MultiPic;
                $image->image = $filename;
                //$file->size = $filesize;
                $image->save();*/

        }

        public function logout(){
            Auth::logout();
            return Redirect()->route('login')->with('success', 'Logout successfully');
        }


      }




