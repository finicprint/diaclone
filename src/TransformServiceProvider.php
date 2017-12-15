<?php
declare(strict_types=1);

namespace Diaclone;

use Diaclone\Serializer\SimpleJsonSerializer;
use Illuminate\Support\ServiceProvider;

class TransformServiceProvider extends ServiceProvider
{
    const DEFAULT_CONFIG = __DIR__ . '/../config/diaclone.php';

    public function boot()
    {
        $this->publishes([
            self::DEFAULT_CONFIG => config_path('diaclone.php'),
        ]);
    }

    public function register()
    {
        $this->registerTransform();
    }

    protected function registerTransform()
    {
        $this->mergeConfigFrom(self::DEFAULT_CONFIG, 'diaclone');

        $serializer = $this->app->config->get('diaclone.serializer');
        $this->app->singleton('transform', function ($app) use ($serializer) {
            return new TransformService(new $serializer);
        });
    }
}
