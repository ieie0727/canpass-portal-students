<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequests as Middleware;

class ThrottleRequests extends Middleware
{
    protected function resolveRequestSignature($request)
    {
        // ここでリクエストのシグネチャを定義できます（通常はデフォルトで十分です）
        return $request->fingerprint();
    }

    protected function getMaxAttempts($request)
    {
        // 制限回数を指定（例：60回）
        return 60;
    }

    protected function getDecayMinutes()
    {
        // 制限がリセットされるまでの時間（例：1分）
        return 1;
    }
}
