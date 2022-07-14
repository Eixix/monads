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
    return new IntegerWithLogs($x->result * $x->result, ["Squared $x->result to get " . ($x->result * $x->result)]);
  }

  public static function addOne(int $x): IntegerWithLogs {
    return new IntegerWithLogs($x->result + 1, ["Added 1 to $x->result to get " . ($x->result + 1)]);
  }
  
  public static function wrapWithLogs(int $x): IntegerWithLogs {
    return new IntegerWithLogs($x, []);
  }

  public static function runWithLogs(IntegerWithLogs $input, callable $applyFunction): IntegerWithLogs 
  {
    $newNumberWithLogs = $applyFunction($input->result);
    return new IntegerWithLogs($newNumberWithLogs->result, array_merge($newNumberWithLogs->logs, $input->logs));
  }

}

$a = Calculate::wrapWithLogs(5);
$b = Calculate::runWithLogs($a, Calculate::square);
$c = Calculate::runWithLogs($b, Calculate::addOne);

echo(json_encode($c));

// FIXME: Code duplication with the array map as well as having another wrapper function
