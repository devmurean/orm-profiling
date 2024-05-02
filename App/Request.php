<?php

namespace App;

use Pecee\SimpleRouter\SimpleRouter;

class Request
{
  public static  function input($index = null, $defaultValue = null, ...$methods)
  {
    $request = SimpleRouter::request();
    if ($index !== null) {
      return $request->getInputHandler()->value($index, $defaultValue, ...$methods);
    }

    return $request->getInputHandler();
  }
}
