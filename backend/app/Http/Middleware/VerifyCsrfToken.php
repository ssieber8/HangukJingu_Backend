<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\App;

class VerifyCsrfToken extends Middleware {
  protected $except = [
  ];

  function handle($request, Closure $next) {
    // skip csrf check in dev environment
    if (App::environment(['local', 'dev'])) {
      return $next($request);
    }

    return parent::handle($request, $next);
  }
}