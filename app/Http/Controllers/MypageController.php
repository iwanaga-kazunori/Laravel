<?php

namespace App\Http\Controllers;

use App\FavoriteTeams;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Team;
use App\User;

class MypageController extends Controller
{
    //
    public function uploadImage(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $file_name = $request->file->getClientOriginalName();
        
        // 取得したファイル名で保存
        $request->file->storeAs('public/images/' , $file_name);
        // ファイル情報をDBに保存
        $user->update(['profile_image' => $file_name]);
        
        return $user;
    }

    public function apiTeams(): \Illuminate\Http\JsonResponse
    {
        $teams = Team::get();
        
        return response()->json($teams);
    }

    public function favoriteTeamsCreate(Request $request)
    {
        $teams= $request->selectedTeams;
        FavoriteTeams::create([
            'user_id' => $request->id, 
            'favorite_teams' => $teams,
        ]);
    }

    public function favoriteTeamsRead(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->id;
        $data = FavoriteTeams::where('user_id', '=', $id)->first();
        return response()->json($data);
    }

    public function favoriteTeamsUpdate(Request $request)
    {
        $user_id = $request->id;
        $teams= FavoriteTeams::where('user_id', $user_id)->first();
        $teams->favorite_teams=$request->editTeams;
        $teams->save();
    }
}
