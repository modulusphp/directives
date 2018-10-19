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
    $this->message = '"' . $view . '" does not exist.';
  }
}
