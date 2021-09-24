<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\FlowerCategory;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    public function companies(){
        Session::forget('page');
        Session::put('page','admin-companies');
        $companies=Company::orderBy('id', 'DESC')->get();
        return view('admin.companies.companies')->with(compact('companies'));
    }
    public function companiesAddEdit(Request $request,$id=null){
        
        if($id==""){
            $title="Add Company";
            $companies=new Company();
            $companiesData=array();
            $massege="Company has been saved";
        }else {
            $title="Edit Company";
            $companiesData=Company::where('id',$id)->first();
            $massege="Company has been updated";
            $companies= Company::find($id);
        }
        if ($request->isMethod('post')) {
            $data=$request->all();
            $rule=[
                'name'=>'required|regex:/^[A-Za-z- ]+$/',
                'url'=>'required|url',
            ];
            $customMsg=[
                'name.required'=>"Company Name must not be empty",
                'name.regex'=>"Company Name formate invalid.only latter and - will allow",
            ];
            $this->validate($request,$rule,$customMsg); 
            
            $companies->name=$data['name'];
            $companies->url=$data['url'];
            $companies->save();
            Session::flash('success_msg',$massege);
            return redirect('admin/companies');
        }
        return view('admin.companies.add-edit')->with(compact('title','companiesData',));
    }

    //delete company
    public function companiesDelete($id){
        Company::where('id',$id)->delete();
        Session::flash('success_msg','Company has been deleted successfully.');
        return redirect('/admin/companies');
    }
    //add price
    public function addEditPrice(Request $request){
        Session::forget('page');
        Session::put('page','admin-price');
        if ($request->isMethod('post')) {
            $data=$request->all();
            $dataArr=array();
            foreach ($data['price'] as $key => $value) {
                $dataArr[$key]['price']=$value;
            }
            foreach ($data['ids'] as $key => $value) {
                $id=explode('-',$value);
                $dataArr[$key]['category_id']=$id[0];
                $dataArr[$key]['company_id']=$id[1];
            }
            $arrSL=serialize($dataArr);
           Price::updateOrCreate(['id'=>1],[
                'value'=>$arrSL
           ]);

           Session::flash('success_msg',"Price has been saved");
           return redirect('admin/price');
        }
        $companies=Company::orderBy('id', 'DESC')->get();
        $categories=FlowerCategory::with(['season'=>function($query){
            $query->select('id','name');
        },'type'=>function($query){
            $query->select('id','name');
        }])->orderBy('id', 'ASC')->get();
        $price=Price::findOrFail(1);
        $priceArr=unserialize($price->value);
        return view('admin.companies.add-edit-price')->with(compact('companies','categories','priceArr'));
    }
    // price calculate
    public function priceCalculate(Request $request){
        Session::forget('page');
        Session::put('page','admin-price-calculate');
        $companies=Company::orderBy('id', 'DESC')->get();
        $categories=FlowerCategory::with(['season'=>function($query){
            $query->select('id','name');
        },'type'=>function($query){
            $query->select('id','name');
        }])->orderBy('id', 'ASC')->get();
        $price=Price::findOrFail(1);
        $priceArr=unserialize($price->value);
        return view('admin.price-calculate')->with(compact('companies','categories','priceArr'));
    }

}
