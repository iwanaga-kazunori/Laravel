<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiTokenService;

class ApiTokenController extends Controller
{
    private ApiTokenService $apiTokenService;
    public function __construct(ApiTokenService $apiTokenService)
    {
       $this->apiTokenService = $apiTokenService;
    }

    /**
     * 認証済みのユーザーのAPIトークンを更新する
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function update(Request $request)
    {
        return $this->apiTokenService->update($request);
    }
}
