<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Image;
use Carbon\Carbon;
class ImageController extends Controller
{
    //
    public function getImageInput(){
        return view('images/image_input');
    }
    
    public function postImageConfirm(Request $request){
        $file_name = $request->file('imagefile')->getClientOriginalName();
        $post_data = $request->except('imagefile');
        $imagefile = $request->file('imagefile');
        
        $temp_path = $imagefile->storeAs('public/temp', $file_name);
        $read_temp_path = str_replace('public/', 'storage/', $temp_path);
        $image_name = $post_data['image_name'];
        
        $data = array(
            'temp_path' => $temp_path,
            'read_temp_path' => $read_temp_path,
            'image_name' => $image_name,
        );
        
        $request->session()->put('data', $data);
    
        return view('images/image_confirm', compact('data') );
    }

    public function postImageComplete(Request $request) {
        $data = $request->session()->get('data');
        $temp_path = $data['temp_path'];
        $read_temp_path = $data['read_temp_path'];
    
        $filename = str_replace('public/temp/', '', $temp_path);
        //ファイル名は$temp_pathから"public/temp/"を除いたもの
        $storage_path = 'public/images/'.$filename;
        //画像を保存するパスは"public/images/xxx.jpeg"
    
        $request->session()->forget('data');
    
        Storage::move($temp_path, $storage_path);
        //Storageファサードのmoveメソッドで、第一引数->第二引数へファイルを移動
    
        $read_path = str_replace('public/', 'storage/', $storage_path);
        //商品一覧画面から画像を読み込むときのパスはstorage/images/xxx.jpeg"
        $image_name = $data['image_name'];

        $image = new Image;
        $image_data = array('path' => $read_path , 'image_name' => $image_name);
        $image->fill($image_data);
        $image->save();
        return view('images/image_complete');
    }
}
