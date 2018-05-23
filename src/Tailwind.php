<?php

namespace ZakNesler\TailwindPreset;

use Illuminate\Support\Arr;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Console\Presets\Preset;

class Tailwind extends Preset
{
    /**
     * Setup basic assets.
     *
     * @return void
     */
    private static function setup()
    {
        static::ensureComponentDirectoryExists();
        static::updatePackages();

        static::installScripts();
        static::installStyles();
        static::updateExampleComponent();

        static::removeNodeModules();
    }

    /**
     * Install single welcome view.
     *
     * @return void
     */
    public static function install()
    {
        static::setup();

        File::copyDirectory(__DIR__.'/stubs/views/default', resource_path('views'));
    }

    /**
     * Install authentication files.
     *
     * @return void
     */
    public static function installWithAuth()
    {
        static::setup();
        static::installAuthRoutes();

        file_put_contents(app_path('Http/Controllers/HomeController.php'), static::compileControllerStub());

        File::copyDirectory(__DIR__.'/stubs/views/auth', resource_path('views'));
    }

    /**
     * Install authentication routes if they are not present.
     *
     * @return void
     */
    protected static function installAuthRoutes()
    {
        if (str_contains(file_get_contents(base_path('routes/web.php')), 'Auth::routes();')) {
            return;
        }

        file_put_contents(
            base_path('routes/web.php'),
            "\nAuth::routes();\n\nRoute::get('/home', 'HomeController@index')->name('home');\n",
            FILE_APPEND
        );
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        return array_merge([
            'less' => '^3.0',
            'less-loader' => '^4.1',
            'laravel-mix-purgecss' => '^2.1',
            'laravel-mix-tailwind' => '^0.1',
        ], Arr::except($packages, [
            'bootstrap',
            'popper.js',
            'jquery',
            'lodash'
        ]));
    }

    /**
     * Compile the HomeController class.
     *
     * @return void
     */
    protected static function compileControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            Container::getInstance()->getNamespace(),
            file_get_contents(__DIR__.'/stubs/controllers/HomeController.stub.php')
        );
    }

    /**
     * Install all JavaScript files.
     *
     * @return void
     */
    protected static function installScripts()
    {
        copy(__DIR__.'/stubs/webpack.stub.mix.js', base_path('webpack.mix.js'));

        copy(__DIR__.'/stubs/js/app.stub.js', resource_path('assets/js/app.js'));
        copy(__DIR__.'/stubs/js/bootstrap.stub.js', resource_path('assets/js/bootstrap.js'));

        copy(__DIR__.'/stubs/tailwind.stub.js', base_path('tailwind.js'));
    }

    /**
     * Install stylesheets.
     *
     * @return void
     */
    protected static function installStyles()
    {
        File::deleteDirectory(resource_path('assets/sass'));

        if (! file_exists(resource_path('assets/less'))) {
            mkdir(resource_path('assets/less'), 0777, true);
        }

        copy(__DIR__.'/stubs/less/app.stub.less', resource_path('assets/less/app.less'));
    }

    /**
     * Update the example Vue component.
     *
     * @return void
     */
    protected static function updateExampleComponent()
    {
        File::cleanDirectory(resource_path('assets/js/components'));

        copy(
            __DIR__.'/stubs/js/components/ExampleComponent.stub.vue',
            resource_path('assets/js/components/ExampleComponent.vue')
        );
    }
}
