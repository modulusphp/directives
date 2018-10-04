<?php

namespace Modulus\Directives;

use AtlantisPHP\Medusa\Directive;

class Csrf extends Directive
{
	/**
	 * Directive name
	 *
	 * @var string $name
	 */
	protected $name = 'csrf_token';

	/**
	 * Handle directive
	 *
	 * @return string
	 */
	public function message() : string
	{
		return '<input type="hidden" name="csrf_token" value="{{ $csrf_token }}">';
	}
}