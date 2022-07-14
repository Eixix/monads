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
  public static function square(IntegerWithLogs $x): IntegerWithLogs {
    return new IntegerWithLogs($x->result * $x->result, array_merge($x->logs, ["Squared $x->result to get " . ($x->result * $x->result)]));
  }

  public static function addOne(IntegerWithLogs $x): IntegerWithLogs {
    return new IntegerWithLogs($x->result + 1, array_merge($x->logs, ["Added 1 to $x->result to get " . ($x->result + 1)]));
  }

  public static function wrapWithLogs(int $x): IntegerWithLogs {
    return new IntegerWithLogs($x, []);
  }
}

echo(json_encode(Calculate::square(Calculate::addOne(Calculate::wrapWithLogs(2)))));

// FIXME: Code duplication with the array map as well as having another wrapper function
