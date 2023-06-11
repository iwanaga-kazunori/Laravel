<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Team;
use Carbon\Carbon;
class TeamMasterController extends Controller
{
    //
    public function getTeamInput(){
        return view('team_master/team_input');
    }

    public function postTeamConfirm(Request $request){
        $file_name = $request->file('imagefile')->getClientOriginalName();
        $post_data = $request->except('imagefile');
        $imagefile = $request->file('imagefile');
        
        $temp_path = $imagefile->storeAs('public/temp', $file_name);
        $read_temp_path = str_replace('public/', 'storage/', $temp_path);
        $team_name_ja = $post_data['team_name_ja'];
        $team_name_de = $post_data['team_name_de'];
        
        $data = array(
            'temp_path' => $temp_path,
            'read_temp_path' => $read_temp_path,
            'team_name_ja' => $team_name_ja,
            'team_name_de' => $team_name_de,
            'file_name' => $file_name,
        );
        
        $request->session()->put('data', $data);
    
        return view('team_master/team_confirm', compact('data') );
    }

    public function postTeamComplete(Request $request) {
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
        $team_name_ja = $data['team_name_ja'];
        $team_name_de = $data['team_name_de'];
        $file_name = $data['file_name'];

        $team = new Team;
        $team_data = array('team_name_ja' => $team_name_ja , 'team_name_de' => $team_name_de ,'path' => $read_path , 'file_name' => $file_name );
        $team->fill($team_data);
        $team->save();
        return view('team_master/team_complete');
    }
}
