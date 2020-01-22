<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/17
 * Time: 16:09
 */

namespace App\Http\Controllers;

use App\Http\Requests\WelcomeRequest;
use App\Models\Message;
use Illuminate\Support\Facades\DB;


class WelcomeController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function messagePost(WelcomeRequest $request){
        $data = $request->post();

        DB::beginTransaction();
        try {
            //保存留言
            $model = new Message;
            $model->nickname = $data['nickname'];
            $model->type = $data['type'];
            $model->contact = $data['contact'];
            $model->content = $data['content'];
            $model->ip = request()->ip();
            $model->save();

            DB::commit();
        } catch(\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors('提交失败！');
        }

        return redirect('/')->with('status', '提交成功！');
    }
}