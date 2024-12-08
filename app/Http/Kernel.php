<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
  /**
   * グローバルに適用されるミドルウェアのスタック。
   *
   * これらのミドルウェアはアプリケーションのすべてのリクエストで実行されます。
   *
   * @var array
   */
  protected $middleware = [
    // リクエストのトリミング
    \App\Http\Middleware\TrimStrings::class,
    // Cookieの暗号化
    \App\Http\Middleware\EncryptCookies::class,
  ];

  /**
   * ルートグループ用のミドルウェアスタック。
   *
   * @var array
   */
  protected $middlewareGroups = [
    'web' => [
      \App\Http\Middleware\EncryptCookies::class,
      \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
      \Illuminate\Session\Middleware\StartSession::class,
      \Illuminate\View\Middleware\ShareErrorsFromSession::class,
      \App\Http\Middleware\VerifyCsrfToken::class,
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

    'api' => [
      'throttle:60,1',  // APIリクエストの制限
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
  ];

  /**
   * 特定のルートに割り当てるミドルウェア
   *
   * @var array
   */
  protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'csrf' => \App\Http\Middleware\VerifyCsrfToken::class,
    'throttle' => \App\Http\Middleware\ThrottleRequests::class,
    'redirectIfAuthenticated' => \App\Http\Middleware\RedirectIfAuthenticated::class,
  ];
}
