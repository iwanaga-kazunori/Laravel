<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Tester;

class TestController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = User::find(20);
        $favoriteteams = $user->favoriteteams;
        dump($favoriteteams);

        return view('feed.test', ['favoriteteams' => $favoriteteams]);
    }

    public function update(Request $request)
    {
        $auth = Auth::user();
        $id = $auth->id;
        
        $user = User::find($id)->favoriteteams()->favorite_teams;
        dd($user);
        $user->name = $request->name;
        
        // dd($request->name);
    }
}
