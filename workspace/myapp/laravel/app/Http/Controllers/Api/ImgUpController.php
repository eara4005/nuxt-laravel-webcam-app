<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ImgUpController extends Controller
{


    private $member;
    
    public function __construct()
    {
        $this->member = new Member();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        // postされたbase64を取り出し
        $img = $request->input('img');


        $name = $request->input('name');
        // base64文字列のData-URL宣言の削除
        $base64Str = str_replace(' ', '+', preg_replace('/^data:image.*base64,/', '', $img));
        // デコード + public直下に保存
        file_put_contents('testCap.jpg', base64_decode($base64Str));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $member = $this->member->showAllNames();
        return response()->json([$member]);
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
}
