<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ItemBoughtMail;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function index(){
        $product = \App\Models\Gallery::orderBy('id','desc')->paginate(12);
        return view('home',['product'=>$product]);
    }

    public function sucess(){
        if(!Auth()->check()){
            dd('Access Denied');
        }

        Mail::to(auth()->user()->email)->send(new ItemBoughtMail());
        $userCart = \App\Models\Cart::select('*')->where('user_id','=',auth()->user()->id);
        $userCart->delete();

        return view('payment.sucess');
    }

    public function failed(){
        if(!Auth()->check()){
            dd('Access Denied');
        }
        Mail::to(auth()->user()->email)->send(new \App\Mail\TransactionFailed());
        return view('payment.failed');
    }

    public function search(){
        $res = request()->validate([
            'search'=>'',
        ]);
        $searchResult = \App\Models\Gallery::where('price','LIKE','%'.$res['search'].'%')->orWhere('title','LIKE','%'.$res['search'].'%')->orWhere('description','LIKE','%'.$res['search'].'%')->paginate(12);
        
        return view('search', ['product'=>$searchResult]);
    }
    
}
