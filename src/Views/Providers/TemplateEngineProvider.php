<?php

namespace App\Views\Providers;

use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

class TemplateEngineProvider
{
  static $i = false;

  public static function getInstance()
  {
    if (!self::$i) {
      self::$i = new Mustache_Engine([
        'loader' => new Mustache_Loader_FilesystemLoader(
          __DIR__.'/../Templates',
          [ 'extension' => '.tpl' ]
        )
      ]);
    }

    return self::$i;
  }
}
