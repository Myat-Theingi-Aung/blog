<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdateRequest;

class UserFrontController extends Controller
{

    /**
     * To show user details information
     *
     * @param  int  $id user id
     * @return View details page
     */
    public function show(User $user)
    {
        if($user->images()->exists()){
            $image = $user->images[0]->path;  
        }else{
            $image = '';
        }

        return view('user.profile.show',compact('user','image'));
    }

    /**
     * To store old value in edit page
     * 
     * @param int $id product id
     * @return View profile edit page
     */
    public function edit(User $user)
    {
        if($user->id != Auth::id()){
            return redirect()->back();
        }

        return view('user.profile.edit',compact('user'));
    }

    /**
     * To update user by id
     * 
     * @param UserUpdateRequest $request request with inputs
     * @param int $id user id
     * @return View profile index
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->address = $request['address'];
        $user->update();

        if(request()->hasFile('image')){
            $file = request()->file('image');
            $file_name = uniqid(time()) . '_' . $file->getClientOriginalName();
            if($image = Image::where('imagable_id',$user->id)->where('imagable_type','App\Models\User')->first()){
                unlink(public_path('img/users/'.$image->name));     
                $file_path = 'img/users'."/$file_name";
                $image->name = $file_name;
                $image->path = 'img/users'."/$file_name";           
            }else{
                $image = new Image();
                $image->name = $file_name;
                $image->path = 'img/users'."/$file_name";
            }
            $file->move(public_path('img/users'), 'img/users'."/$file_name");
            $user->images()->save($image); 
        }
        Toastr::success('Profile Update Successfully!','SUCCESS');

        return redirect()->route('profile.show',compact('user'));
    }

    /**
     * To show user product page
     * 
     * @return View user product profile page
     */
    public function userProduct(User $user)
    {
        $products = Product::where('user_id', $user->id)->get();
        $user = User::with('images')->where('id',$user->id)->get();
        
        return view('user.profile.index',compact('products','user'));
    }

}
