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
        $serializer = $this->getJsonSerializer();
        $this->app->singleton('transform', function ($app) use ($serializer) {
            return new TransformService($serializer);
        });
    }

    protected function getJsonSerializer()
    {
        $serializer = $this->app->config->get('diaclone.serializer');

        return $serializer ? new $serializer : new SimpleJsonSerializer();
    }
}
