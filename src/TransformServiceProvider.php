<?php
declare(strict_types = 1);

namespace Diaclone;

use Diaclone\Serializer\SimpleJsonSerializer;
use Illuminate\Support\ServiceProvider;

class TransformServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->registerTransform();
    }

    protected function registerTransform()
    {
        $this->app->singleton('transform', function ($app) {
            return new TransformService(new SimpleJsonSerializer());
        });
    }
}