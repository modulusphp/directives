<?php

namespace Modulus\Directives;

use AtlantisPHP\Medusa\Directive;

class Using extends Directive
{
  /**
   * Default engine
   *
   * @var string $language
   */
  public static $engine = 'modulus';

  /**
   * Views path
   *
   * @var string $views
   */
  public static $views;

  /**
   * Directive name
   *
   * @var string $name
   */
  protected $name = 'using';

  /**
   * Handle directive
   *
   * @return string
   */
  public function message(string $path) : string
  {
    $path = $this->getPath($path);
    return self::$engine == 'modulus' ? "{% extends($path) %}" : "@extends($path)";
  }

  /**
   * getPath
   *
   * @param string $path
   * @return string
   */
  private function getPath(string $path) : string
  {
    $path = str_replace('"', "", $path);
    $path = str_replace("'", "", $path);

    $views = self::$views;
    $file = explode('.', $path);

    foreach($file as $name) {
      if (is_dir($views . DIRECTORY_SEPARATOR . $name)) {
        $views = $views . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR;
      }
      else {
        $views = $views . (ends_with($views, '/') ? '' : '.') . $name;
      }
    }

    $parent = substr(self::$views, strrpos(self::$views, DIRECTORY_SEPARATOR) + 1);

    if (str_contains($views, $parent . '.')) {
      $views = str_replace($parent . '.', $parent . DIRECTORY_SEPARATOR, $views);
    }

    return str_replace(self::$views, '', $views);
  }
}
