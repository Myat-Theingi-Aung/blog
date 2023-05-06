<?php

namespace App\Http\Controllers\User;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Mail\ProductDeleteMail;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductFrontController extends Controller
{

    /**
     * Show product create form
     *
     * @return View product create page
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('user.product.create',compact('categories'));
    }

    /**
     * To store product information
     * 
     * @param ProductRequest $request request with inputs
     * @return View home page
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->user_id = Auth::id();
        $product->title = $request['title'];
        $product->price = $request['price'];
        $product->description = $request['description'];
        $product->save();

        foreach($request['category-names'] as $cid){
            $category = Category::find($cid);
            $product->categories()->attach($category);
        }

        $image = new Image();
        $file = request()->file('image');
        
        $fileName = uniqid(time()) . '_' . $file->getClientOriginalName();
        $image->name = $fileName;
        $image->path = 'img/products/'.$fileName;

        $file->move(public_path('img/products'), 'img/products/'.$fileName);
        $product->images()->save($image);
        
        Toastr::success('Product Create Successfully!','SUCCESS');
        
        return redirect()->route('home');
    }

    /**
     * To show product detail information
     *
     * @param  int  $id product id
     * @return $product Product Object
     */
    public function show(Product $product)
    {
        if($product->user->images()->exists()){
            $image = $product->user->images[0]->path;  
        }else{
            $image = '';
        }
        
        return view('user.product.show',compact('product','image'));
    }

    /**
     * To store old value in edit page
     * 
     * @param int $id product id
     * @return View profile edit page
     */
    public function edit(Request $request,Product $product)
    {
        if (Gate::allows('update-product', $product)) {
            $categories = Category::all();
            return view('user.product.edit',compact('product','categories'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * To update product by id
     * 
     * @param ProductUpdateRequest $request request with inputs
     * @param int $id product id
     * @return View home
     */ 
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->user_id = Auth::id();
        $product->title = $request['title'];
        $product->price = $request['price'];
        $product->description = $request['description'];
        $product->update();

        $product->categories()->detach();
        foreach($request['category-names'] as $cid){
            $category = Category::find($cid);
            $product->categories()->attach($category);
        }

        if(request()->hasFile('image')){
            $file = request()->file('image');
            $fileName = uniqid(time()) . '_' . $file->getClientOriginalName();

            if($image = Image::where('imagable_id',$product->id)->where('imagable_type','App\Models\Product')->first())
            {
                unlink(public_path('img/products/'.$image->name));
                $image->name =  $fileName;
                $image->path = 'img/products/'.$fileName;                       
            }else
            {
                $image = new Image();
                $image->name = $fileName;~
                $image->path = 'img/products/'.$fileName;
            }
            $file->move(public_path('img/products'), 'img/products/'.$fileName);
            $product->images()->save($image); 
        }
        Toastr::success('Product Update Successfully!','SUCCESS');

        return redirect()->route('home');
    }

    /**
     * To delete product by id
     *
     * @param  int  $id product id
     * @return View home
     */
    public function destroy(Product $product)
    {
        $image = Image::where('imagable_type','App/Models/Product')->where('imagable_id',$product->id)->count();
        if($image > 0){
            unlink(public_path('img/products/').$product->images[0]->name);          
            $product->images()->delete();  
        }
        $product->categories()->detach();
        $product->delete();

        Mail::to($product->user->email)->send(new ProductDeleteMail($product));
        Toastr::success('Product Delete Successfully!','SUCCESS');

        return redirect()->route('home');
    }

}
