<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    // if user is not log in, return to login page.
    public function __construct(){
        $this->middleware('auth');

    }


    public function AllCat(){
//        $categories = DB::table('categories')
//            ->join('users', 'categories.user_id','users.id')
//            ->select('categories.*','users.name')
//            ->latest()->paginate(5);


        //Create Paginate for Categories and Trash Categories
       $categories = Category::latest()->paginate(5);
       $trachCat = Category::onlyTrashed()->latest()->paginate(3);

//     $categories = DB::table('categories')->latest()->paginate(5);

        //
        return view('admin.category.index', compact('categories', 'trachCat'));
    }


        //Function for Adding Category both ways, ORM & Query Builder
    public function AddCat(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255', ],
            [
                'category_name.required' => 'Please Input Category Name',
                'category_name.max' => 'Category Less Than 255Chars',

                ]);

        Category::insert([
           'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' =>Carbon::now()
        ]);

//        $category = new Category;
//        $category->category_name = $request->category_name;
//        $category->user_id = Auth::user()->id;
//        $category->save();

//        $data = array();
//        $data['category_name'] = $request->category_name;
//        $data['user_id'] = Auth::user()->id;
//        DB::table('categories')->insert($data);

        return Redirect()->back()->with('success','Category Inserted Successfully');

    }


    //Edit function
    public function Edit($id){
//      $categories = Category::find($id);
        $categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit', compact('categories'));
    }

    //Update Funciton
    public function update(request $request ,$id){
//        $update = Category::find($id)->update([
//            'category_name' => $request->category_name,
//            'user_id' => Auth::user()->id
//
//        ]);

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);
         return Redirect()->route('all.category')->with('success','Category Updated Successfully');
    }

    //Delete Category and move it to Trash list
    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category Deleted Sucessfully');
    }

    //Restore category from Trash
    public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category Restore Successfully');

    }
    //Permanent Delete for category
    public function Pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
         return Redirect()->back()->with('success','Category Permanentyly Deleted');
    }


}
