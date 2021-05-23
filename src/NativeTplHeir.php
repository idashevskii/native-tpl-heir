<?php declare(strict_types=1);

/**
 * @license   MIT
 * 
 * @author    Ilya Dashevsky
 * 
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

class NativeTplHeir {
  private static array $renderersMap = []; // map slotName -> list or renderes
  public static ?string $currentRender = null;

  public static function handleBlock(string $name, Closure $render = null, bool $output = false) {
    self::$currentRender = $name;
    if (!isset(self::$renderersMap[$name])) {
      self::$renderersMap[$name] = [];
    }
    if ($render) {
      array_push(self::$renderersMap[$name], $render);
    }
    if ($output) {
      $render = array_shift(self::$renderersMap[$name]);
      if ($render) {
        $render();
      }
    }
  }
}

function block(string $name, Closure $render) {
  NativeTplHeir::handleBlock($name, $render);
}

function slot(string $name, Closure $render = null) {
  NativeTplHeir::handleBlock($name, $render, true);
}

function super() {
  NativeTplHeir::handleBlock(NativeTplHeir::$currentRender, null, true);
}
