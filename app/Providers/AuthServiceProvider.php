<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションのポリシーマッピング。
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * サービスの登録
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 必要に応じてGateを定義
        // Gate::define('view-admin', function ($user) {
        //     return $user->is_admin;
        // });
    }
}
