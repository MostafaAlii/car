<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\{App,File};
class ObservableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $models = File::allFiles(app_path('Models'));
        foreach ($models as $model) {
            $modelClass = App::getNamespace() . 'Models\\' . $model->getFilenameWithoutExtension();
            $observerClass = App::getNamespace() . 'Observers\\' . $model->getFilenameWithoutExtension() . 'Observer';
            if (class_exists($observerClass)) {
                $modelClass::observe($observerClass);
            }
        }
    }
}
