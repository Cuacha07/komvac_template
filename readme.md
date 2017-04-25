<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](http://patreon.com/taylorotwell):

- **[Vehikl](http://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Styde](https://styde.net)**
- **[Codecourse](https://www.codecourse.com)**
- [Fragrantica](https://www.fragrantica.com)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).






















# Komvac Laravel 5.4 Template With CMS

Simple Template with CMS powered by Laravel 5.4, it's based on Reactor CMS by gmlo89 (link: https://github.com/gmlo89/reactor-cms) and
Nhitrort90 (link: https://github.com/nhitrort90/cms).

## Modules included:

Users (CRUD, Auth)
CMSUsers (CRUD, Auth)
Categories (CRUD) (Soon...)
Articles (CRUD) (Soon...)

## Installation

**First, pull in the package through Composer.**
```php
“require”: {
    ...
    "nhitrort90/cms": "dev-master"
}
```
**And run composer:**

$ composer update
**And then, include the service provider within config/app.php.**
```php
'providers' => [
    ...
    // own
    Nhitrort90\CMS\Providers\CMSServiceProvider::class,
    // Required
    Collective\Html\HtmlServiceProvider::class,
],

....

'aliases' => [
    ...
    // Custom
    'CMS'    => Nhitrort90\CMS\Facades\CMS::class,
    'Field'  => Nhitrort90\CMS\Facades\FieldBuilder::class,
    'Alert'  => Nhitrort90\CMS\Facades\Alert::class,
    'MediaManager' => Nhitrort90\CMS\Facades\MediaManager::class,
    // Required
    'Form' => Collective\Html\FormFacade::class,
    'Html' => Collective\Html\HtmlFacade::class,
],
```
**Configure your preference database.**

###Configure the CMS

$ php artisan cms:start
**Run this command and type the required data.**

**Make sure update the auth.php config file with the User Model of the CMS.**
```php
    'model' => \Nhitrort90\CMS\Modules\Users\User::class,
```
**Also you can set more configurations on config/cms.php.**

**Enjoy it!**

**Go to the web browser and put your-domain/admin.**

## Credits

This package uses a number of open source projects to work properly:

* Laravel 5.1 - The PHP Framework For Web Artisans
* AdminLTE - Dashboard & Control Panel Template
* VueJS - Intuitive, Fast and Composable MVVM for building interactive interfaces.
* TinyMCE - HTML WYSIWYG editor
* gmlo89's Reactor CMS And others...

[@hugo_knihtr]:https://twitter.com/hugo_knihtr