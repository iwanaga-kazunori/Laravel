<?php
namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
class ApiTokenService
{
    /**
     * 認証済みのユーザーのAPIトークンを更新する
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function update(Request $request)
    {
        $token = Str::random(60);
        
        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();
        // dd($token);
        return ['token' => $token];
        
    }
}