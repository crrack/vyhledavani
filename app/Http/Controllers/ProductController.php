<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $input = explode(' ', $request->s);
        $products = Product::query();

        foreach($input as $word){
          $products->where(function($query) use ($word){
              $query->where('name', 'like', '%'.$word.'%')
              ->orWhere('description', 'like', '%'.$word.'%')
              ->orWhere('url', 'like', '%'.$word.'%');
          });
        }

        $products = $products->get(['name', 'description']);

        return response(['products' => $products], 200);
    }
}
