<?php

namespace Modulus\Directives\Exceptions;

use Exception;

class PartialNotFoundException extends Exception
{
  /**
   * __construct
   *
   * @param string $view
   * @return void
   */
  public function __construct(string $view)
  {
    $position = count(debug_backtrace()) == 21 ? 14 : 13;

    if (isset(debug_backtrace()[$position])) {
      $args = debug_backtrace()[$position];

      foreach ($args as $key => $value) {
        $this->{$key} = $value;
      }
    }

    $this->message = '"' . $view . '" does not exist.';
  }
}
