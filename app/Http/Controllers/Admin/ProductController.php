<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Mail\ProductDeleteMail;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductImportRequest;

class ProductController extends Controller
{
    /**
     * To show product information
     * 
     * @param Request $request request with inputs
     * @return $product product object
     */
    public function index(Request $request)
    {
        if($request->isMethod('get')){
            $search = $request->input('title');
            
            if($request->has('search')){
                $products = Product::with('categories')->with('user')
                ->whereHas('user', function($q) use($search){
                    if($search){
                        $q->where('name', 'like', '%'.$search.'%');
                    }
                })->orwhere('title','LIKE','%'.$search.'%')
                ->paginate(10);
                
            }elseif($request->has('export')){
                $products = Product::with('categories')->with('user')
                ->whereHas('user', function($q) use($search){
                    if($search){
                        $q->where('name', 'like', '%'.$search.'%');
                    }
                })->orwhere('title','LIKE','%'.$search.'%')
                ->get();
                
                return Excel::download(new ProductsExport($products) , 'product'.uniqid(time()).'.csv');
            }else{
                $products = Product::orderBy('id','desc')->paginate(10);
            }
            
            return view('admin.product.index',compact('products','request'));
        }
    }

    /**
     * To show product detail information
     *
     * @param  int  $id product id
     * @return $product Product Object
     */
    public function show(Product $product)
    {
        return view('admin.product.show',compact('product'));
    }


    /**
     * To delete product by id
     *
     * @param  int  $id product id
     * @return View index product and sending email to user
     */
    public function destroy(Product $product)
    {
        if($product){
            $product->categories()->detach();
            $product->delete();
        }

        Mail::to($product->user->email)->send(new ProductDeleteMail($product));
        Toastr::success('Product Delete Successfully!','SUCCESS');
        
        return redirect()->route('admin.product.index');
    }

    /**
     * To import product information
     * 
     * @param ProductImportRequest $request request with inputs 
     * @return View index product
     */
    public function import(ProductImportRequest $request) 
    {
        Excel::import(new ProductsImport, $request['file']);
        Toastr::success('CSV Import Successfully!','SUCCESS');
        
        return redirect()->route('admin.product.index')->with('success', 'All good!');
    }
}
