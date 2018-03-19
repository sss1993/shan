<?php

namespace App\Http\Controllers\shop;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\shop;
use App\Http\Model\h_user;
use Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shop.login.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function doLogin(Request $request) {

        // 验证用户名和密码是否为空
        if (empty($request->uname)) {
            return response()->json(['error'=>'请输入用户名']);
        }
        if (empty($request->passwd)) {
            return response()->json(['error'=>'请输入密码']);
        }
        // 获取用户信息
        $h_user = h_user::where('uname',$request->uname)->first();
        // 验证是否为商户
        if ($h_user->isshoper != 2) {
            return response()->json(['error'=>'对不起，您不是商户']);
        }
        // 验证用户是否存在
        if($h_user) {
            // 验证密码是否正确
            if ($request->passwd == $h_user->passwd) {
                session(['uid'=>$h_user->id]);
                $shop = shop::where('uid',$h_user->id)->get();
                return response()->json($shop);
            } else {
                return response()->json(['error'=>'用户名与密码不匹配']);
            }
        } else {
            return response()->json(['error'=>'此用户不存在']);
        }
        
    }

    public function shopInfo($id) {
        session(['sid'=>$id]);
        return redirect('shop');
    }

    public function exita() {
        session()->forget('uid','sid');
        return redirect('shop/login');
    }
}
