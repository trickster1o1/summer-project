<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if(auth()->user()->id == '1'){
            return redirect('/adminpannel');
        }
        $i = \App\Models\Cart::select('*')->where('user_id',auth()->user()->id)->get();
        return view('cart.index',['items'=>$i]);
    }

    public function addItem($item){
        if (Auth()->user()->id == 1) {
            return redirect('/');
        }
        $i = \App\Models\Gallery::findOrFail($item);

        $check = auth()->user()->carts()->where('cart_id','=',$i->id)->exists();
        if(!$check){
            if (auth()) {
                auth()->user()->carts()->create([
                    'title'=>$i->title,
                    'cart_id'=>$i->id,
                    'description'=>$i->description,
                    'price'=>$i->price,
                    'product'=>$i->product,
                ]);
            }
        }
        
        return redirect('/');
    }

    public function removeItem($item){
        
        $i = \App\Models\Cart::findOrFail($item);
        $i->delete();
        
        return redirect('/cart');
    }

    public function cancelCart(){
        $userCart = Auth()->user()->carts()->delete();
        return redirect('/cart');
    }
}
