<?php

namespace Pjhile\JsonApiToon;

use Illuminate\Support\ServiceProvider;
use LaravelJsonApi\Events\ServerBooted;
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

        // Official v5+ way: listen for when any server has booted, then add the encoder
        $this->app['events']->listen(ServerBooted::class, function (ServerBooted $event) {
            $event->server->encoder('application/toon', new ToonEncoder());
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/json-api-toon.php', 'json-api-toon');
    }
}
