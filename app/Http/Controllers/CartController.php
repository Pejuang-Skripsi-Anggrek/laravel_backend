<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function store_cart(Request $request)
    {
        // $cart = Cart::create([
        //     'id_user' => $request->id_user,
        //     'id_product' => $request->id_product,
        //     'qty' => $request->qty 
        // ]);
        // if(Cart::where('id_product', $request->id_product)->count()>0){
        // } else {
        //     $cart = Cart::where('id_product', $request->id_product)->get();
        //     $cart->toQuery()->update([
        //         'qty' => ($cart->qty + $request->qty)
        //     ]);
        // }

        return response([
            'message' => 'Success input cart',
            'cart' => $request->id_user,
            'cart2' => $request->id_product,
            'cart3' => $request->qty
        ]);
    }
    
    public function cart(Request $request){
        $cart = Cart::where('id_user', $request->id_user)->get();

        $list_product=array();
        
        foreach ($cart as $value) {
            array_push($list_product,Product::find($value->id_product).'qty : '.Cart::find($value->id)->qty);
          }

        return response([
            'message' => 'Success get cart',
            'cart' => $list_product
        ]);
    }

    public function delete_cart(Request $request)
    {
        $cart = Cart::where('id_product', $request->id_product);
        $cart->delete();
        return response(['message' => 'Success deleted cart']);
    }
}
