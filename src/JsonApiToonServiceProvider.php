<?php

namespace Pjhile\JsonApiToon;

use Illuminate\Support\ServiceProvider;
use LaravelJsonApi\Contracts\Server\Server;
use Pjhile\JsonApiToon\Encodings\ToonEncoding;

class JsonApiToonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/json-api-toon.php' => config_path('json-api-toon.php'),
            ], 'config');
        }

        $this->app->booted(function () {
            /** @var Server $server */
            $server = $this->app->make(Server::class);
            $server->encoding('application/toon', new ToonEncoding());
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/json-api-toon.php', 'json-api-toon');
    }
}
