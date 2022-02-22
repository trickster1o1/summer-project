<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if (Auth()->user()->id == '1') {    
            $user = \App\Models\User::paginate(10);
            $gallery = \App\Models\Gallery::paginate(10);
            return view('Admin.adminPannel',['user'=>$user,'gallery'=>$gallery]);
        } else {
            dd('Unauthorized');
        }
    }

    public function remove($product) {
        if (Auth()->user()->id == '1') {    
            $productComment = \App\Models\Review::select('*')->where('gallery_id','=',$product);
            $product = \App\Models\Gallery::findOrFail($product);
            $product->delete();
            $productComment->delete();
            $productComment->delete();

            return redirect('/adminpannel');
            
        } else {
            dd('Unauthorized');
        }
    }

    public function update($product) {
        if (Auth()->user()->id == '1') {    
        $product = \App\Models\Gallery::findOrFail($product);
        
        return view('admin.update', ['product'=>$product]);
        } else {
            dd('Unauthorized');
        }
    }

    public function edit($product){
        if (Auth()->user()->id == '1') {    
        $data = request()->validate([
            'title'=>'required',
            'description'=>'',
            'price'=>'required',
        ]);

        $product = \App\Models\Gallery::findOrFail($product);

        $product->update([
            'title'=>$data['title'],
            'description'=>$data['description'],
            'price'=>$data['price'],
        ]);
        
        return redirect('/adminpannel');
        } else {
            dd('Unauthorized');
        }
    }

    public function rmvUser($user){
        $rev = \App\Models\Review::select('*')->where('user_id','=',$user)->get();
        $u = \App\Models\User::findOrFail($user);

        if (count($u->carts) > 0) {
            $u->carts()->delete();
        }
        if (count($rev) > 0) {     
            $rev = \App\Models\Review::select('*')->where('user_id','=',$user);
            $rev->delete();
        }

        $u->delete();
        return redirect('/adminpannel');
        
    }
}
