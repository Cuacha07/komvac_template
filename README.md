# Komvac Laravel 5.4 Template With AdminLTE CMS 

Simple Template with AdminLTE CMS powered by Laravel 5.4, it's based on Reactor CMS by gmlo89 (link: https://github.com/gmlo89/reactor-cms) and
Nhitrort90 (link: https://github.com/nhitrort90/cms).

## Modules included:

* Users (CRUD, Auth)
* CMSUsers (CRUD, Auth)
* Categories (CRUD) (Soon...)
* Articles (CRUD) (Soon...)

## Installation

**Clone it.**
```
git clone https://github.com/Cuacha07/komvac_template.git "myproject"
```
### Change Remote Git Repo
**Remove Actual origin Repo Url**
```
git remote rm origin
```
**Add new one**
```
git remote add origin "your new origin repo url"
```

**Git Init**
```
git init
```

**Run Composer Update:**

```
cd /folder
composer update
```

**Make .env file and generate key:**

```
cp .env.example .env
php artisan key:generate
```

**Configure your database preferences and stuff.**

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:OvLvoufDsdf332343S+03kB3xI8uGEfFjBNVnU=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost
APP_LOCALE=es

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=template
DB_USERNAME=root
DB_PASSWORD=''
```

**Run Migrations.**

```
php artisan migrate
```

**Go to the web browser and put your-domain/admin.**

### CMS Commands

**Run this command to create blank CMS module.**
```
php artisan cms:createmodule
```

**Run this command to add new cms user**
```
php artisan cms:adduser
```

**More Info Soon...**

**Also you can set more configurations on config/cms.php.**

**Enjoy it!**

## Credits

This package uses a number of open source projects to work properly:

* Laravel 5.4 - The PHP Framework For Web Artisans
* AdminLTE - Dashboard & Control Panel Template
* VueJS - Intuitive, Fast and Composable MVVM for building interactive interfaces.
* TinyMCE - HTML WYSIWYG editor
* gmlo89's Reactor CMS - Nhitrort90 Komvac CMS And others...
