<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SeasonController extends Controller
{
    public function seasons(){
        Session::forget('page');
        Session::put('page','admin-seasons');
        $seasons=Season::orderBy('id', 'DESC')->get();
        return view('admin.season.season_list')->with(compact('seasons'));
    }
    public function addEditSeason(Request $request,$id=null){
        
        if($id==""){
            $title="Add Season";
            $seasons=new Season();
            $seasonsData=array();
            $massege="Season has been saved";
        }else {
            $title="Edit Season";
            $seasonsData=Season::where('id',$id)->first();
            $massege="Season has been updated";
            $seasons= Season::find($id);
        }
        if ($request->isMethod('post')) {
            $data=$request->all();
            $rule=[
                'name'=>'required|regex:/^[A-Za-z- ]+$/',
            ];
            $customMsg=[
                'name.required'=>"Session Name must not be empty",
                'name.regex'=>"Session Name formate invalid.only latter and - will allow",
            ];
            $this->validate($request,$rule,$customMsg); 
            
            $seasons->name=$data['name'];
            $seasons->save();
            Session::flash('success_msg',$massege);
            return redirect('admin/seasons');
        }
        return view('admin.season.add-edit')->with(compact('title','seasonsData',));
    }

        //delete season
        public function deleteSeason($id){
            Season::where('id',$id)->delete();
            Session::flash('success_msg','Season has been deleted successfully.');
            return redirect('/admin/seasons');
        }
}
