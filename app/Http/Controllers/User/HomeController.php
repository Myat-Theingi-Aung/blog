<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * To show Product Information
     *
     * @return View home page
     */
    public function index(Request $request)
    {
        if($request->basePath == null){
            $lang = $request->lang;
        }

        App::setlocale($lang);
        if($request->isMethod('get')){
            $search = $request->input('title');
            
            if($request->has('search')){
                $products = Product::with('categories')->with('user')
                ->whereHas('user', function($q) use($search){
                    if($search){
                        $q->where('name', 'like', '%'.$search.'%');
                    }
                })->orwhere('title','LIKE','%'.$search.'%')
                ->paginate(6);
                
            }else{
                $products = Product::orderBy('id','desc')->paginate(6);
            }
        }
        return view('home',[$lang],compact('products','request'));
    }

}
