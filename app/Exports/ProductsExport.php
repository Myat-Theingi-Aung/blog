<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements WithHeadings,FromCollection,WithMapping
{
    use Exportable;

    // a place to store the team dependency
    protected $product;

    // use constructor to handle dependency injection
    public function __construct($product)
    {
        $this->product = $product;
    }

    // set the collection of product to export
    public function collection()
    {
            return $this->product;
    }       

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($product): array
    {
        return [
            $product->id,
            $product->user->name,
            $product->title,
            $product->description,
            $product->price,
            $product->categories()->implode('name',','),   
            $product->images->implode('name')       
        ];
    }


    public function headings(): array
    {
        return[
            'Id',
            'Username',
            'Title',
            'Description',
            'Price',
            'Category Name',
            'Image'
        ];
    }
}
