<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection,WithHeadingRow
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $user = User::where('name',$row['username'])->get();
            $product = Product::where('id',$row['id'])->first();
            $count = Product::where('id',$row['id'])->count();

            $data = Product::updateOrCreate(
                [
                    'id'=>$row['id']
                ],
                [
                    'user_id' => $user->pluck('id')['0'],
                    'title' => $row['title'],
                    'price' => $row['price'],
                    'description' => $row['description'],
                ]
            );
            $cName = $row['category_name'];
            $categories = explode(',', $cName);
            if($count != null){
                if($row['del'] == 'yes'){
                    $product->categories()->detach();
                    $product->delete();
                }else{
                    $product->categories()->detach();
                    foreach($categories as $value){
                        $category = Category::where('name',$value)->get();
                        $cat_id = $category->pluck('id');
                        $data->categories()->attach($cat_id);
                    } 
                }
            }
            else{
                foreach($categories as $value){
                        $category = Category::where('name',$value)->get();
                        $cat_id = $category->pluck('id');
                        $data->categories()->attach($cat_id);
                } 
            }  
      }
   }

}
