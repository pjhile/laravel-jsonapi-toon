<?php

namespace Pjhile\JsonApiToon;

use Illuminate\Support\ServiceProvider;
use LaravelJsonApi\Facades\JsonApi; // ← this is the correct facade
use Pjhile\JsonApiToon\Encoders\ToonEncoder;

class JsonApiToonServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/json-api-toon.php' => config_path('json-api-toon.php'),
            ], 'config');
        }

        // Correct way in v5.1+: use the JsonApi facade helper
        JsonApi::extend(function ($server) {
            $server->encoder('application/toon', new ToonEncoder());
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/json-api-toon.php', 'json-api-toon');
    }
}
