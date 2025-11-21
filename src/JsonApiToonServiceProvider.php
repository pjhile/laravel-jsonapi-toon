<?php

namespace Pjhile\JsonApiToon;

use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use Illuminate\Support\ServiceProvider;
use Pjhile\JsonApiToon\Http\Responses\ToonResponder;

class JsonApiToonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/json-api-toon.php' => config_path('json-api-toon.php'),
            ], 'config');
        }

        // Auto-register TOON for all APIs
        JsonApi::defaultEncoding([
            'application/vnd.api+json',
            config('json-api-toon.media-type', 'application/toon') => ToonResponder::class,
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/json-api-toon.php', 'json-api-toon');
    }
}
