<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlowerCategory;
use App\Models\Season;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FlowerCategoryController extends Controller
{
    public function flowerCategories(){
        Session::forget('page');
        Session::put('page','admin-flower-categories');
        $categories=FlowerCategory::with(['season'=>function($query){
        $query->select('id','name');
    },'type'=>function($query){
        $query->select('id','name');
    }])->orderBy('id', 'DESC')->get();
        return view('admin.flower_categories.flower_categories')->with(compact('categories'));
    }
    public function categoriesAddEdit(Request $request,$id=null){
        
        if($id==""){
            $title="Add Flower Type";
            $categories=new FlowerCategory();
            $categoriesData=array();
            $massege="Flower Type has been saved";
        }else {
            $title="Edit Flower Type";
            $categoriesData=FlowerCategory::where('id',$id)->first();
            $massege="Flower Type has been updated";
            $categories= FlowerCategory::find($id);
        }
        $seasonsArray=Season::select('id','name')->get();
        $typesArray=Type::select('id','name')->get();
        if ($request->isMethod('post')) {
            $data=$request->all();
            $rule=[
                'seasons'=>'required|numeric|min:1',
                'types'=>'required|numeric|min:1',
                'name'=>'required|regex:/^[A-Za-z- ]+$/',
            ];
            $customMsg=[
                'name.required'=>"Flower Type Name must not be empty",
                'name.regex'=>"Flower Type Name formate invalid.only latter and - will allow",
            ];
            $this->validate($request,$rule,$customMsg); 
            
            $categories->name=$data['name'];
            $categories->season_id=$data['seasons'];
            $categories->type_id=$data['types'];
            $categories->save();
            Session::flash('success_msg',$massege);
            return redirect('admin/categories');
        }
        return view('admin.flower_categories.add-edit')->with(compact('title','categoriesData','seasonsArray','typesArray'));
    }

        //delete Type
        public function categoriesDelete($id){
            FlowerCategory::where('id',$id)->delete();
            Session::flash('success_msg','Flower Type has been deleted successfully.');
            return redirect('/admin/categories');
        }
}
