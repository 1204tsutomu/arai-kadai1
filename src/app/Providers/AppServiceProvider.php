<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // ← これを追加しないとエラーになります！

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot() {}
}
