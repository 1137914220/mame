<?php

namespace App\Http\Controllers;

use App\Good;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GoodController extends Controller
{
    //
    public function index(Request $request)
    {
        $data=$request->except('_token');
        if (Auth::attempt($data)){
            return view('list');
        }
    }

    public function save(Request $request)
    {
        $this->validate($request,[
           'title'=>'required' ,
            'sev' =>'required'
        ]);
        $data=$request->except('_token');
        DB::table('goods')->insert($data);
        return view('addd');
    }
//    业务员登录
    public function lot(Request $request)
    {
        $data=$request->except('_token');
        DB::table('goods')->where('sev',$data['sev'])->get();
        return view('lot');
    }

    public function age()
    {
        $data= DB::table('goods')->paginate(3);
        return view('kot',compact('data'));
    }
    public function name(Request $request){
        $data=DB::table('goods')->where('title','like',"%$data%")->paginate(2);
        return view('kotl',compact('data'));
    }
}
