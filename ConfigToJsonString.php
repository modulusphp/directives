<?php

namespace Modulus\Directives;

use AtlantisPHP\Medusa\Directive;

class configToJsonString extends Directive
{
  /**
   * Directive name
   *
   * @var string $name
   */
  protected $name = 'configToJson';

  /**
   * Handle directive
   *
   * @return string
   */
  public function message($config) : string
  {
    $config = $this->cleanString($config);
    return json_encode(config($config));
  }

  /**
   * Clean string
   *
   * @param mixed $config
   * @return mixed $config
   */
  private function cleanString($config)
  {
    $config = str_replace('\'', '', $config);
    $config = str_replace('"', '', $config);

    return $config;
  }
}