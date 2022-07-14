<?php

class IntegerWithLogs {
  var $result;
  var $logs;

  public function __construct(int $result, array $logs) {
    $this->result = $result;
    $this->logs = $logs;
  }
}

class Calculate {
  public static function square(int $x): IntegerWithLogs {
    return new IntegerWithLogs($x * $x, ["Squared $x to get " . ($x * $x)]);
  }

  public static function addOne(int $x): IntegerWithLogs {
    return new IntegerWithLogs($x + 1, ["Added 1 to $x to get " . ($x + 1)]);
  }
}

echo(json_encode(Calculate::square(2)));

// FIXME: Not working
// square(square(2))
