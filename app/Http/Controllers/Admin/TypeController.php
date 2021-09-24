<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TypeController extends Controller
{
    public function types(){
        Session::forget('page');
        Session::put('page','admin-types');
        $types=Type::orderBy('id', 'DESC')->get();
        return view('admin.types.types')->with(compact('types'));
    }
    public function typesAddEdit(Request $request,$id=null){
        
        if($id==""){
            $title="Add Type";
            $types=new Type();
            $typesData=array();
            $massege="Type has been saved";
        }else {
            $title="Edit Type";
            $typesData=Type::where('id',$id)->first();
            $massege="Type has been updated";
            $types= Type::find($id);
        }
        if ($request->isMethod('post')) {
            $data=$request->all();
            $rule=[
                'name'=>'required|regex:/^[A-Za-z- ]+$/',
            ];
            $customMsg=[
                'name.required'=>"Type Name must not be empty",
                'name.regex'=>"Type Name formate invalid.only latter and - will allow",
            ];
            $this->validate($request,$rule,$customMsg); 
            
            $types->name=$data['name'];
            $types->save();
            Session::flash('success_msg',$massege);
            return redirect('admin/types');
        }
        return view('admin.types.add-edit')->with(compact('title','typesData',));
    }

        //delete Type
        public function typesDelete($id){
            Type::where('id',$id)->delete();
            Session::flash('success_msg','Type has been deleted successfully.');
            return redirect('/admin/types');
        }
}
