<?php

namespace Komvac\CMS\Providers;

use App\Http\Kernel;
use Komvac\CMS\Modules\Users\User;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Komvac\CMS\CMS;
use Blade;

class CMSServiceProvider extends ServiceProvider
{

    protected $file_config;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        include __DIR__ . '/../helpers.php';
        $this->file_config = $file_config = __DIR__ . '/../config/cms.php';
        $this->mergeConfigFrom($this->file_config, 'cms');
        $this->publishFiles();

        // Translations
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'CMS');

        // Load our views
        $this->loadViewsFrom(__DIR__ . '/../views', 'CMS');
        $router->middleware('CMSAuthenticate', 'Komvac\CMS\Middleware\CMSAuthenticate');
        $this->app['config']->set('auth.model', 'Komvac\CMS\Modules\Users\User');
        $this->extendBlade();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/../routes.php';

        $this->app['cms'] = $this->app->share(function($app){
           return new CMS();
        });

        //Hugin Commands
        $this->app->singleton('command.cms.start', function ($app) {
            return $app['Komvac\CMS\Commands\StartCommand'];
        });
        $this->commands('command.cms.start');
        
        $this->app->singleton('command.cms.createmodule', function ($app) {
            return $app['Komvac\CMS\Commands\CreateModule'];
        });
        
        $this->commands('command.cms.createmodule');

        $this->app->singleton('command.cms.deletemodule', function ($app) {
            return $app['Komvac\CMS\Commands\DeleteModule'];
        });
        
        $this->commands('command.cms.deletemodule');

        $this->registerFakers();
    }

    protected function registerFakers()
    {
        // Users
        $factory = app('Illuminate\Database\Eloquent\Factory');
        $factory->defineAs(User::class, 'cms_site_demo', function ($faker) {
            return [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => str_random(10),
                'type' => $faker->randomElement(['admin', 'editor']),
                'remember_token' => str_random(10),
            ];
        });


        // Categories
        $factory->defineAs( Category::class, 'cms_site_demo', function ($faker) {
            $title = $faker->sentence;
            return [
                'title'         => $title,
            ];
        });

        // Articles
        $factory->defineAs( Article::class, 'cms_site_demo', function ($faker) {
            $sumary = $faker->paragraph;
            $title = $faker->sentence;
            return [
                'title'         => $title,
                'slug_url'      => str_slug($title),
                'primary_img'   => null,
                'sumary'        => $sumary,
                'body'          => $faker->text,
                'title_seo'     => $title,
                'meta_keywords'     => implode(', ', $faker->words(10)),
                'meta_description'  => $sumary,
                'category_id'       => $faker->numberBetween(1, 5),
                'created_by'        => $faker->numberBetween(1, 5),
                'views'             => $faker->numberBetween(0, 200),
                'published_at'      => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            ];
        });
    }

    protected function publishFiles()
    {
        // Config
        $this->publishes([
            $this->file_config => base_path('config/cms.php'),
        ]);

        // Assets
        $this->publishes([
            __DIR__.'/../assets' => public_path('vendor/Komvac/cms'),
        ], 'public');

        $this->shareGlobalVariables();
    }
}
