<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Aws\Laravel\AwsFacade as AWS;
use Aws\Rekognition\RekognitionClient;

class ImgUpController extends Controller
{


    private $member;
    
    public function __construct()
    {
        $this->client = new RekognitionClient([
            'version' => 'latest',
            'region' => 'ap-northeast-1'
        ]);
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
        $img = $request->input('img'); // リクエストから写真(base64)の取り出し
        $name = $request->input('name'); // リクエストからnameの取り出し

        $s3 = AWS::createClient('s3'); // s3クライアントの生成
        $s3->putObject(array(
            'Bucket'     => 'necomata-rekogtion-test', // s3で登録したbucketの名前
            'Key'        => $name.'.jpg', // 登録したいファイルの名前
            'SourceFile' => $img, // 登録したいファイル
        ));

        /** 
         *  base64文字列のData-URL宣言の削除
         *  $base64Str = str_replace(' ', '+', preg_replace('/^data:image.*base64,/', '', $img));
         *  デコード + public直下に保存
         *  file_put_contents('testCap.jpg', base64_decode($base64Str));
        */
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

    public function indexFaces(){
        //　特に何もしない
    }

    /**
     * nameとs3内の写真をコレクションに追加する処理
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreIndexFaces(Request $request){

        $name = $request->input('name'); // リクエストからnameを取り出し

        // index-faces s3にコレクション登録処理
        // https://docs.aws.amazon.com/ja_jp/rekognition/latest/dg/add-faces-to-collection-procedure.html
        // https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#indexfaces
        $result = $this->client->indexFaces([
            'CollectionId' => 'faces-list',
            'DetectionAttributes' => [
                "DEFAULT"
            ],
            'ExternalImageId' => $name,
            'Image' => [
                'S3Object' => [
                    'Bucket' => 'necomata-rekogtion-test',
                    'Name' => $name.'.jpg',
                ],
            ],
        ]);
    }

    
}
