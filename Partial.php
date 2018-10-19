<?php

namespace Modulus\Directives;

use AtlantisPHP\Medusa\Directive;
use Modulus\Directives\Exceptions\PartialNotFoundException;

class Partial extends Directive
{
  /**
   * Views extension
   *
   * @var string $extension
   */
  public static $extension;

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
  protected $name = 'partial';

  /**
   * Handle directive
   *
   * @return string
   */
  public function message($view) : string
  {
    $view = $this->getPath($view);
    $path = self::$views . $view . self::$extension;

    if (file_exists($path)) {
      return '<!--%' .base64_encode($view). '%-->' . PHP_EOL . file_get_contents($path);
    }
    else {
      throw new PartialNotFoundException($path);
    }
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
