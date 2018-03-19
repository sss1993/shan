<?php

namespace App\Http\Controllers\shop;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\hf_type;

class FoodCateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 搜索菜品名称
        $tname = empty($request->input('tname'))?'':$request->input('tname');

        // 限定每页显示条数
        if ($request->has('pagenum')) {
            $page = $request->pagenum;
        } else {
            $page = 5;
        }

        // 这里要限定商铺id搜索条件
        $data = hf_type::where('tname','like',"%$tname%")->where('sid',session('sid'))->paginate($page);

        return view('shop.foodcate.index',compact('data','tname','page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->ftype;
        $res = hf_type::insert(['tname'=>$data,'sid'=>session('sid')]);
        
        if ($res) {
            return 1;
        } else {
            return 2;
        }

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
        $data = $request->ftype;
        $res = hf_type::where('id',$id)->update(['tname'=>$data]);

        if ($res) {
            return 1;
        } else {
            return 2;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = hf_type::where('id', $id)->delete();
        return $res;
    }
}
