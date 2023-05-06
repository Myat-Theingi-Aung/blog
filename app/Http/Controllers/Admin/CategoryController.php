<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    /**
     * To show category information
     * 
     * @param Request $request search name
     * @return View category index page
     */
    public function index(Request $request)
    {
        if($request['name']!= null){
            $categories = Category::where('name','LIKE','%'.$request->name.'%')->paginate(10);               
        }else{
            $categories = Category::orderBy('id','desc')->paginate(10);
        }

        return view('admin.category.index',compact('categories','request'));
    }

    /**
     * To show category create page
     *
     * @return View category create page
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * To store category information
     *
     * @param  CategoryRequest $request with input data
     * @return View category index page
     */
    public function store(CategoryRequest $request)
    {
        Category::create([
            "name" => $request->name,
        ]);
        Toastr::success('Category Create Successfully!','SUCCESS');
        
        return redirect()->route('admin.category.index');
    }

   
    /**
     * To store old value in edit page
     * 
     * @param int $id category id
     * @return View category edit page
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
    }

    /**
     * To update category by id
     * 
     * @param CategoryUpdateRequest $request request with inputs
     * @param int $id category id
     * @return View category index
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update([
            "name" => $request->name,
        ]);
        Toastr::success('Category Update Successfully!','SUCCESS');
        
        return redirect()->route('admin.category.index');
    }

    /**
     * To delete category by id
     *
     * @param  int  $id category id
     * @return View category index page 
     */
    public function destroy(Category $category)
    {
        if($category){
            $category->delete();
        }
        Toastr::success('Category Delete Successfully!','SUCCESS');
        
        return redirect()->back();
    }
}
