<?php

namespace Komvac\CMS\Facades;

use Illuminate\Support\Facades\Facade;


class CMS extends Facade {
    protected static function getFacadeAccessor() { return 'cms'; }
}