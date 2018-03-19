<?php

namespace App\Http\Controllers\shop;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\h_food;
use App\Http\Model\hf_type;
use App\Http\Model\shop;

use Intervention\Image\ImageManagerStatic as Image;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 搜索菜品名称
        $foodname = empty($request->input('foodname'))?'':$request->input('foodname');

        // 限定每页显示条数
        if ($request->has('pagenum')) {
            $page = $request->pagenum;
        } else {
            $page = 5;
        }

        // 这里要限定商铺id搜索条件
        $data = h_food::where('f_name','like',"%$foodname%")->where('sid',session('sid'))->paginate($page);

        // 获取类别名
        foreach($data as $k=>$v) {
            $data[$k]['f_tname'] = hf_type::where('id',$v->tid)->where('sid',session('sid'))->value('tname');
        }

        return view('shop.food.index',compact('data','foodname','page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hf_type = hf_type::get();
        return view('shop.food.create',compact('hf_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        // $data['tid'] = $request->get('tid');

        // 上传图片
        // 是否存在图片
        if ($request->hasFile('f_pic')) {
            // 图片是否有效
            if ($request->file('f_pic')->isValid()) {
                $name = time().mt_rand(1000,9999);
                // 获取文件后缀
                $ext = $request->file('f_pic')->getClientOriginalExtension();
                
                $fileName = $name.'.'.$ext;
                // 转移图片位置
                $request -> file('f_pic') -> move('./food_pic', $fileName);

                if ($request->file('f_pic')->getError() > 0) {
                    return redirect('shop/food/create')->with('error', '上传图片失败');
                } else {
                    // dd(233333);
                    // 使用第三方图片处理类(Intervention Image)
                    $img = Image::make('./food_pic/'.$fileName);
                    $img->resize(100, 100, function($constraint){
                        $constraint->aspectRatio();
                    });
                    $img->save('./food_pic/s_'.$fileName);
                    // 存到数据库
                    $data['f_pic'] = '/food_pic/'.$fileName;
                }
            }
        }

        $this->validate($request,[
            'f_name'    =>'required',
            'f_price'  =>'required',
            'tid' =>'required',
            'f_status'    =>'required'
        ],[
            'f_name.required'   => '请填写菜品名称',
            'f_price.required' => '请填写菜品单价',
            'tid.required'   => '请选择菜品类型',
            'f_status.required'   => '请选择菜品状态'
        ]);
        $data['sid'] = session('sid');
        $res = h_food::insert($data);

        if($res){
            return redirect('shop/food')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
        $foodDetail = h_food::where('id', $id)->first();
        $tid = $foodDetail->tid;
        $tname = hf_type::where('id',$tid)->select('tname')->first();

        return view('shop.food.detail',compact('foodDetail','tname'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hf_type = hf_type::where('sid',session('sid'))->get();
        $h_food = h_food::where('id',$id)->first();
        return view('shop.food.edit',compact('hf_type','h_food'));
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
        $data = $request->except('_token','_method');
        // $data['tid'] = $request->get('tid');

        // 上传图片
        // 是否存在图片
        if ($request->hasFile('f_pic')) {
            // 图片是否有效
            if ($request->file('f_pic')->isValid()) {
                $name = time().mt_rand(1000,9999);
                // 获取文件后缀
                $ext = $request->file('f_pic')->getClientOriginalExtension();
                
                $fileName = $name.'.'.$ext;
                // 转移图片位置
                $request -> file('f_pic') -> move('./food_pic', $fileName);

                if ($request->file('f_pic')->getError() > 0) {
                    return redirect('shop/food/create')->with('error', '上传图片失败');
                } else {
                    // 使用第三方图片处理类(Intervention Image)
                    $img = Image::make('./food_pic/'.$fileName);
                    $img->resize(100, 100, function($constraint){
                        $constraint->aspectRatio();
                    });
                    $img->save('./food_pic/s_'.$fileName);
                    // 存到数据库
                    $data['f_pic'] = '/food_pic/'.$fileName;
                }
            }
        }

        $this->validate($request,[
            'f_name'    =>'required',
            'f_price'  =>'required',
            'tid' =>'required',
            'f_status'    =>'required'
        ],[
            'f_name.required'   => '请填写菜品名称',
            'f_price.required' => '请填写菜品单价',
            'tid.required'   => '请选择菜品类型',
            'f_status.required'   => '请选择菜品状态'
        ]);

        $res = h_food::where('id', $id)->where('sid',session('sid'))->update($data);

        if($res){
            return redirect('shop/food')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
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
        $res = h_food::where('id', $id)->delete();
        return $res;
    }
}
