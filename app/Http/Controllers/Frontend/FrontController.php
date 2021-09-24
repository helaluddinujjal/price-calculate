<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\FlowerCategory;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
      // price calculate
      public function priceCalculate(Request $request){
          if (Auth::check()) {
             $name=Auth::user()->name;
             if (Auth::user()->is_varify!=1) {
                //Auth::logout();
                return view('frontend.users.email-varify',compact('name'));
            }
            if (Auth::user()->status!=1) {
                Auth::logout();
                return view('frontend.users.disable-account',compact('name'));
            }
          
            Session::forget('page');
            Session::put('page','home');
            $companies=Company::orderBy('id', 'DESC')->get();
            $categories=FlowerCategory::with(['season'=>function($query){
                $query->select('id','name');
            },'type'=>function($query){
                $query->select('id','name');
            }])->orderBy('id', 'ASC')->get();
            $price=Price::findOrFail(1);
            $priceArr=unserialize($price->value);
            return view('frontend.price-calculate')->with(compact('companies','categories','priceArr'));
        }else{
            return abort(404);
        }
    }
}
