<?php

namespace RocktoonDevelop\SimpleBasicAuth;

use Illuminate\Support\ServiceProvider;


class SimpleBasicAuthServiceProvider extends ServiceProvider {

    protected $config;
    protected $stub;


    public function __construct($app) {
        $this->config = __DIR__ . '/config.php';
        $this->stub   = __DIR__ . '/config.stub';

        if (!file_exists($this->config)) {
            $this->createConfig();
        }

        parent::__construct($app);
    }

    public function boot(\Illuminate\Routing\Router $router) {
        $this->publishes([
            $this->config => config_path('simple_basic_auth.php')
        ]);

        $router->aliasMiddleware('auth.simple_basic', \RocktoonDevelop\SimpleBasicAuth\Http\Middleware\SimpleBasicAuth::class);
    }

    public function register() {
        $this->mergeConfigFrom($this->config, 'simple_basic_auth');
    }

    private function createConfig() {
        $data = file_get_contents($this->stub);
        return file_put_contents($this->config, $data);
    }
}
