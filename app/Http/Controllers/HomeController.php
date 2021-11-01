<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class HomeController extends Controller
{
    public function HomeSlider() {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider() {
        return view('admin.slider.create');
    }


    public function StoreSlider(Request $request) {
        $slider_image = $request->file('image');

        //Image Intervention
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);
        $last_img = 'image/slider/'.$name_gen;


        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with('success','Slider Inserted Successfully');
    }

        public function Edit($id){
            $sliders = Slider::find($id);
            return view('admin.slider.edit', compact('sliders'));

        }

    public function Update(Request $request, $id){
        $validatedData = $request->validate([

            'image' => 'mimes:jpg,jpeg,png',
        ]);


        //We create the replacement for the current image
        $old_image = $request->old_image;


        $image = $request->file('image');


        if($image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/slider/';
            $last_img = $up_location.$img_name;
            $image->move($up_location,$img_name);
            //Create unlink the for old image
            unlink($old_image);
            //ORM
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->route('home.slider')->with('success','Slider Updated Successfully');
        }

        else{
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->route('home.slider')->with('success','Slider Updated Successfully');
        }


        // The same as for uploading, it is also for changing the current image

    }
    public function Delete($id){
        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return Redirect()->back()->with('success','Slider Deleted Successfully');

    }


}
