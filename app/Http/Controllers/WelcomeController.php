<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/17
 * Time: 16:09
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function messagePost(Request $request){
        dd($request->all());
    }
}