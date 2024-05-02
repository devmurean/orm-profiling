<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter;

/**
 * @return \Pecee\Http\Request
 */
function request(): Request
{
  return SimpleRouter::request();
}

/**
 * Get input class
 * @param string|null $index Parameter index name
 * @param string|mixed|null $defaultValue Default return value
 * @param array ...$methods Default methods
 * @return \Pecee\Http\Input\InputHandler|array|string|null
 */
function input($index = null, $defaultValue = null, ...$methods)
{
  if ($index !== null) {
    return request()->getInputHandler()->value($index, $defaultValue, ...$methods);
  }

  return request()->getInputHandler();
}
